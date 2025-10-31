<?php

namespace App\Http\Controllers\Students;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Http\Controllers\Controller;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PaymentMethods\StripeController;
use App\Http\Controllers\WalletController;
use App\Http\Requests\Students\BookAppointmentRequest;
use App\Http\Resources\Web\BookAppointmentsResource;
use App\Models\AppointmentSchedule;
use App\Models\AppointmentScheduleSlot;
use App\Models\AppointmentStatus;
use App\Models\AppointmentType;
use App\Models\BankAccount;
use App\Models\BookAppointment;
use App\Models\FundBankTransfer;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Laravel\Passport\Passport;

class BookAppointmentController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
        // $this->middleware('student');
    }
    public function getter($req = null, $export = null)
    {

        $student = auth()->user()->student;
        if ($req != null) {
            $student_appointments =  $student->appointments()->withAll();
            if ($req->trash && $req->trash == 'with') {
                $student_appointments =  $student_appointments->withTrashed();
            }
            if ($req->trash && $req->trash == 'only') {
                $student_appointments =  $student_appointments->onlyTrashed();
            }
            if ($req->column && $req->column != null && $req->search != null) {
                $student_appointments = $student_appointments->whereLike($req->column, $req->search);
            } else if ($req->search && $req->search != null) {

                $student_appointments = $student_appointments->whereLike(['name', 'description'], $req->search);
            }

            if ($req->status_code) {
                $student_appointments = $student_appointments->where('appointment_status_code', $req->status_code);
            }

            if ($req->sort && $req->sort['field'] != null && $req->sort['type'] != null) {
                $student_appointments = $student_appointments->OrderBy($req->sort['field'], $req->sort['type']);
            } else {
                $student_appointments = $student_appointments->OrderBy('id', 'desc');
            }
            if ($export != null) { // for export do not paginate
                $student_appointments = $student_appointments->get();
                return $student_appointments;
            }
            $totalStudentAppointments = $student_appointments->count();
            $student_appointments = $student_appointments->paginate($req->perPage);
            $student_appointments = BookAppointmentsResource::collection($student_appointments)->response()->getData(true);

            return $student_appointments;
        }
        $student_appointments = BookAppointmentsResource::collection($student->appointments()->withAll()->orderBy('id', 'desc')->paginate(10))->response()->getData(true);
        return $student_appointments;
    }

    public function bookAppointment(BookAppointmentRequest $request)
    {
        $data = $request->all();
        $user = Auth()->user();
        $student = $user->student->id;
        $appointment_type = AppointmentType::where('id', $request->appointment_type_id)->first();
        if ($appointment_type->is_schedule_required) {
            $schedule_slot = AppointmentScheduleSlot::with('appointment_schedule')->where('id', $request->selected_schedule_id)->first();
            $data['start_time'] = $schedule_slot->start_time;
            $data['end_time'] = $schedule_slot->end_time;
            $data['fee'] = $schedule_slot->appointment_schedule->fee;
        } else {
            if (isset($request->teacher_id)) {
                $appointment_schedule = AppointmentSchedule::where('teacher_id', $request->teacher_id)->where('appointment_type_id', $request->appointment_type_id)->first();
            }
            if (isset($request->academy_id)) {
                $appointment_schedule = AppointmentSchedule::where('academy_id', $request->academy_id)->where('appointment_type_id', $request->appointment_type_id)->first();
            }

            $data['start_time'] = null;
            $data['end_time'] = null;
            $data['fee'] = $appointment_schedule->fee;
        }

        $data['student_id'] = $student;
        $data['appointment_status_code'] = AppointmentStatus::$Pending;
        if ($request->hasFile('attachment')) {
            $data['attachment_url'] = uploadFile($request, 'attachment', 'booked_appointments');
        }
        $request->merge([
            'amount' => $data['fee']
        ]);
        if($request->gateway == 'bank-transfer'){

            $fund_request = PaymentController::addFundRequest($request);

            $data['fund_id'] = $fund_request['fund']['id'] ?? null;
            // dd($fund_request['fund']);


                $appointment = BookAppointment::create($data);

                $request->merge(['fee' => $data['fee']]);
                request()->session()->flash('alert', [
                    'type' => 'info',
                    'message' => 'Appointment Booked Successfully',
                ]);
                return redirect(route('students.appointment_bank_transfers',['appointment_id'=> $appointment->id]));

        }
        if ($request->gateway == 'stripe') {
            $fund_request = PaymentController::addFundRequest($request);

            $data['fund_id'] = $fund_request['fund']['id'] ?? null;
            // dd($fund_request['fund']);

            $appointment = BookAppointment::create($data);
            // triggerNotification('bookings', 'appointment_booked', $appointment->id);


            $request->merge(['fee' => $data['fee']]);
            request()->session()->flash('alert', [
                'type' => 'info',
                'message' => 'Appointment Booked Successfully',
            ]);
            return Inertia::location(route('students.appointment_stripe_transfers', ['appointment_id' => $appointment->id]));
        }
        if ($request->gateway == 'wallet') {
            $wallet = new WalletController();
            $wallet_response = $wallet->payThroughUserWallet($request->amount);
            $wallet_response = $wallet_response->getData();
            if ($wallet_response->status) {
                $data['is_paid'] = 1;
                $appointment = BookAppointment::create($data);
                request()->session()->flash('alert', [
                    'type' => 'info',
                    'message' => 'Appointment Booked Successfully',
                ]);
                return redirect()->back()->withResponseData([
                    'appointment' => $appointment,
                ]);
            } else {
                request()->session()->flash('alert', [
                    'type' => 'error',
                    'message' => $wallet_response->msg
                ]);
                return redirect()->back();
            }
        } else {
            $fund_request = PaymentController::addFundRequest($request);
            $data['fund_id'] = $fund_request['fund']['id'] ?? null;
            if ($fund_request['fund'] ?? false) {
                $data['is_paid'] = 0;
                $appointment = BookAppointment::create($data);
                $request->merge(['fee' => $data['fee']]);
                request()->session()->flash('alert', [
                    'type' => 'info',
                    'message' => 'Appointment Booked Successfully',
                ]);
                return redirect()->back()->withResponseData([
                    'appointment' => $appointment,
                    'fund' => $fund_request['fund']
                ]);
            } else {
                request()->session()->flash('alert', [
                    'type' => 'error',
                    'message' => $fund_request,
                ]);
                return redirect()->back()->withErrors($fund_request);
            }
        }
    }
    public function getFilteredAppointmentlogs(Request $request)
    {
        $appointments = $this->getter($request);
        $response = generateResponse($appointments, count($appointments['data']) > 0 ? true : false, 'Filter Appointment Logs Successfully', null, 'collection');
        return response()->json($response, 200);
    }
    public function showAppointmentLogDetailPage($id)
    {
        $user = Auth()->user();
        $student_id = $user->student->id;
        $appointment = BookAppointment::withAll()->where('id', $id)->where('student_id', $student_id)->first();
        $appointment = new BookAppointmentsResource($appointment);
        $gateway = $appointment?->fund?->gateway;
        $data = [
            'appointment' => $appointment,
            'gateway' => $gateway,
        ];
        return Inertia::render('AppointmentLogDetail', $data);
    }
    public function getBankTransfers(Request $request){
        $bank_accounts = BankAccount::active()->get();
        $appointment = BookAppointment::find($request->appointment_id);
        $fund = $appointment->fund;
        return Inertia::render('BankAccounts',[
            'appointment' => $appointment,
            'bank_accounts' => $bank_accounts,
            'fund' => $fund,
        ]);
    }
    public function fundBankTransfer(Request $request)
    {$rules = [
        'bank_account_id' => 'required',
        'attachment' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
    ];

    // Define custom error messages (optional)
    $messages = [
        'bank_account_id.required' => 'The bank account field is required.',
        'attachment.required' => 'The attachment field is required.',
    ];
    $validator = Validator::make($request->all(), $rules, $messages);
    if ($validator->fails()) {
        return redirect()->back()
            ->withErrors($validator)
            ->withInput();
    }
        $data = $request->all();
        if ($request->hasFile('attachment')) {
            $data['attachment'] = uploadFile($request, 'attachment', 'bank_transactions');
        }
        // $data['attachment_url'] = uploadFile($request,'attachment_url','bank_transactions');
        $request->merge(['date' => now()]);


        FundBankTransfer::create($data);
        request()->session()->flash('alert', [
            'type' => 'info',
            'message' => 'Bank Transactions were created successfully',
        ]);
        if ($request->is_fund) {
            return redirect()->route('wallet')->with('message', 'Fund Bank Transfer Created Successfully')->with('message_type', 'success');
        }
        if ($request->is_service) {
            return redirect()->route('service_log')->with('message', 'Fund Bank Transfer Created Successfully')->with('message_type', 'success');
        }

        return redirect()->route('appointment_log')->with('message', 'Fund Bank Transfer Created Successfully')->with('message_type', 'success');
       
    }
}
