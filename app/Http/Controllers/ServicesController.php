<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Http\Controllers\Controller;
use App\Http\Resources\Web\ServiceStatusesResource;
use App\Models\ServiceStatus;

class ServicesController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
        // $this->middleware('verified');
    }

    public function showServiceLogsPage(Request $request){
        $service_statuses = ServiceStatus::active()->get();
        $service_statuses = ServiceStatusesResource::collection($service_statuses);

        $data = [
            'service_statuses' => $service_statuses,
        ];
        return Inertia::render('ServiceLogs/Index',$data);
    }

}
