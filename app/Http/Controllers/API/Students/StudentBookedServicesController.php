<?php

namespace App\Http\Controllers\API\Students;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Http\Controllers\Controller;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PaymentMethods\StripeController;
use App\Http\Requests\API\Students\BookedServiceRequest;
use App\Http\Resources\API\BookedServicesResource;
use App\Models\ServiceSchedule;
use App\Models\ServiceScheduleSlot;
use App\Models\ServiceStatus;
use App\Models\ServiceType;
use App\Models\BookedService;
use App\Models\Service;
use Illuminate\Support\Facades\DB;

class StudentBookedServicesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
        $this->middleware('api');
        $this->middleware('verified');
        $this->middleware('api_setting');
        $this->middleware('student.api');
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

    public function bookService(BookedServiceRequest $request)
    {
        try {
            DB::beginTransaction();
            $data = $request->all();
            $user = Auth()->user();
            $student = $user->student->id;
            $service = Service::where('id', $request->service_id)->first();

            $data['price'] = $service->price;
            $data['teacher_id'] = $service->teacher_id ?? null;
            $data['teacher_id'] = $service->teacher_id ?? null;
            $data['student_id'] = $student;
            $data['service_status_code'] = ServiceStatus::$Pending;
            if ($request->hasFile('attachment')) {
                $data['attachment_url'] = uploadFile($request, 'attachment', 'booked_services');
            }
            $request->merge(['amount' => $data['price'], 'type' => 'service']);

            $fund_request = PaymentController::addFundRequest($request);
            // dd($fund_request);
            $data['fund_id'] = $fund_request['fund']['id'] ?? null;
            if ($fund_request['fund'] ?? false) {
                $data['is_paid'] = 0;
                $service = BookedService::create($data);
                // $request->merge(['fee' => $data['fee']]);
                $service->fund_transaction = $fund_request['fund']->transaction ?? null;
                // $service->fund = $fund_request['fund'];
                $response = generateResponse($service, true, 'Service Booked Successfully', null, 'collection');
                DB::commit();
                return response()->json($response, 200);
            } else {
                $response = generateResponse($fund_request, false, 'Error', null, 'collection');
                return response()->json($response, 200);
            }
        } catch (\Exception $e) {
            DB::rollBack();
            $response = generateResponse(null, false, $e->getMessage(), null, 'collection');
            return response()->json($response, 200);
        }
    }
    public function getFilteredServiceLogs(Request $request)
    {
        $services = $this->getter($request);
        $response = generateResponse($services, count($services['data']) > 0 ? true : false, 'Filter Service Logs Successfully', null, 'collection');
        return response()->json($response, 200);
    }
    public function showServiceLogDetail(BookedService $booked_service)
    {
        $user = Auth()->user();
        $service = BookedService::withAll()->find($booked_service->id);
        return ($booked_service->student_id == $user->student->id)
            ? response()->json(generateResponse(new BookedServicesResource($service), true, 'Service Fetched Successfully', null, 'collection'), 200)
            : response()->json(generateResponse(null, false, 'Service Not Found', null, 'collection'), 404);
    }
}
