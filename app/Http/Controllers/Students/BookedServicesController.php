<?php

namespace App\Http\Controllers\Students;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Http\Controllers\Controller;
use App\Http\Controllers\NotificationSettingsController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PaymentMethods\StripeController;
use App\Http\Controllers\WalletController;
use App\Http\Requests\Students\BookedServiceRequest;
use App\Http\Resources\Web\BookedServicesResource;
use App\Http\Resources\Web\ServicesResource;
use App\Models\BankAccount;
use App\Models\ServiceStatus;
use App\Models\ServiceType;
use App\Models\BookService;
use App\Models\BookedService;
use App\Models\Gateway;
use App\Models\Service;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Laravel\Passport\Passport;

class BookedServicesController extends Controller
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
            $student_services =  $student->services()->withAll();
            if ($req->trash && $req->trash == 'with') {
                $student_services =  $student_services->withTrashed();
            }
            if ($req->trash && $req->trash == 'only') {
                $student_services =  $student_services->onlyTrashed();
            }
            if ($req->column && $req->column != null && $req->search != null) {
                $student_services = $student_services->whereLike($req->column, $req->search);
            } else if ($req->search && $req->search != null) {

                $student_services = $student_services->whereLike(['name', 'description'], $req->search);
            }

            if ($req->status_code) {
                $student_services = $student_services->where('service_status_code', $req->status_code);
            }

            if ($req->sort && $req->sort['field'] != null && $req->sort['type'] != null) {
                $student_services = $student_services->OrderBy($req->sort['field'], $req->sort['type']);
            } else {
                $student_services = $student_services->OrderBy('id', 'desc');
            }
            if ($export != null) { // for export do not paginate
                $student_services = $student_services->get();
                return $student_services;
            }
            $totalStudentServices = $student_services->count();
            $student_services = $student_services->paginate($req->perPage);
            $student_services = BookedServicesResource::collection($student_services)->response()->getData(true);

            return $student_services;
        }
        $student_services = BookedServicesResource::collection($student->services()->withAll()->orderBy('id', 'desc')->paginate(10))->response()->getData(true);
        return $student_services;
    }

    public function showBookServicePage(Request $request, $slug)
    {
        $service = Service::withAll()->withChildrens()->hasModulePermissions()->active()->where('slug', $slug)->first();
        if (!$service) {
            abort(404);
        }
        $service = new ServicesResource($service);
        $gateways = Gateway::where('status', 1)->get();

        return Inertia::render('Services/BookService', [
            'service' => $service,
            "gateways" => $gateways
        ]);
    }

    public function bookService(BookedServiceRequest $request)
    {
        $service = Service::find($request->service_id);
        if ($service) {
            $request->merge(['price' => $service->price, 'teacher_id' => $service->teacher_id ?? null, 'academy_id' => $service->academy_id ?? null]);
        }
        $data = $request->all();
        $user = Auth()->user();
        $student = $user->student->id;

        $data['student_id'] = $student;
        $data['service_status_code'] = ServiceStatus::$Pending;
        if ($request->hasFile('attachment')) {
            $data['attachment_url'] = uploadFile($request, 'attachment', 'booked_services');
        }
        $request->merge([
            'amount' => $data['price'],
            'type' => 'service'
        ]);

        if ($request->gateway == 'bank-transfer') {

            $fund_request = PaymentController::addFundRequest($request);

            // dd($fund_request);
            $data['fund_id'] = $fund_request['fund']['id'] ?? null;


            $appointment = BookedService::create($data);

            $request->merge(['fee' => $data['price']]);
            request()->session()->flash('alert', [
                'type' => 'info',
                'message' => 'Appointment Booked Successfully',
            ]);
            $email_users = [
                'student' => $appointment->student ? User::where('id', $appointment->student->user_id)->first() : null,
                'teacher' => $appointment->teacher ? User::where('id', $appointment->teacher->user_id)->first() : null,
                // 'academy' => User::where('id', $appointment->academy->user_id)->first(),
            ];
            // NotificationSettingsController::fireNotificationEvent($appointment,'book_quick_service',$email_users,'service_log','Service Registred');


            return redirect(route('students.service_bank_transfers', ['service_id' => $appointment->id]));
        }
        if ($request->gateway == 'stripe') {
            $fund_request = PaymentController::addFundRequest($request);

            $data['fund_id'] = $fund_request['fund']['id'] ?? null;
            // dd($fund_request['fund']);

            $service = BookedService::create($data);
            // triggerNotification('bookings', 'service_booked', $service->id);

            // dd($data);
            $request->merge(['fee' => $data['price']]);
            request()->session()->flash('alert', [
                'type' => 'info',
                'message' => 'service Booked Successfully',
            ]);
            return Inertia::location(route('students.service_stripe_transfers', ['service_id' => $service->id]));
        }

        if ($request->gateway == 'wallet') {
            $wallet = new WalletController();
            $wallet_response = $wallet->payThroughUserWallet($request->amount, $request);
            $wallet_response = $wallet_response->getData();
            if ($wallet_response->status) {
                $data['is_paid'] = 1;
                $service = BookedService::create($data);
                request()->session()->flash('alert', [
                    'type' => 'info',
                    'message' => 'Service Booked Successfully',
                ]);

                // $email_users = [
                //     'student' => $service->student ? User::where('id', $service->student->user_id)->first() : null,
                //     'teacher' => $service->teacher ? User::where('id', $service->teacher->user_id)->first() : null,
                //     // 'academy' => User::where('id', $service->academy->user_id)->first(),
                // ];
                // NotificationSettingsController::fireNotificationEvent($service,'book_quick_service',$email_users,'service_log','Service Registred');

                return redirect()->back()->withResponseData([
                    'service' => $service,
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
                $service = BookedService::create($data);
                $request->merge(['fee' => $data['price']]);
                request()->session()->flash('alert', [
                    'type' => 'info',
                    'message' => 'Service Booked Successfully',
                ]);
                // $email_users = [
                //     'student' => $service->student ? User::where('id', $service->student->user_id)->first() : null,
                //     'teacher' => $service->teacher ? User::where('id', $service->teacher->user_id)->first() : null,
                //     // 'academy' => User::where('id', $service->academy->user_id)->first(),
                // ];
                // NotificationSettingsController::fireNotificationEvent($service,'book_quick_service',$email_users,'service_log','Service Registred');
                return redirect()->back()->withResponseData([
                    'service' => $service,
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
    public function getFilteredServiceLogs(Request $request)
    {
        $services = $this->getter($request);

        $response = generateResponse($services, count($services['data']) > 0 ? true : false, 'Filter Service Logs Successfully', null, 'collection');
        return response()->json($response, 200);
    }
    public function showServiceLogDetailPage($id)
    {
        $user = Auth()->user();
        $student_id = $user->student->id;
        $service = BookedService::withAll()->where('id', $id)->where('student_id', $student_id)->first();
        $service = new BookedServicesResource($service);
        $data = [
            'service' => $service,
        ];
        return Inertia::render('ServiceLogs/Detail', $data);
    }


    public function getBankTransfers(Request $request)
    {
        $bank_accounts = BankAccount::active()->get();
        $appointment = BookedService::find($request->service_id);
        $fund = $appointment->fund;
        return Inertia::render('BankAccounts', [
            'appointment' => $appointment,
            'bank_accounts' => $bank_accounts,
            'fund' => $fund,
        ]);
    }
}
