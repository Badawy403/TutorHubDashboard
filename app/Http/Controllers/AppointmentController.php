<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Http\Controllers\Controller;
use App\Http\Resources\Web\AppointmentStatusResource;
use App\Http\Resources\Web\AppointmentTypesResource;
use App\Models\AppointmentStatus;
use App\Models\AppointmentType;

class AppointmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('verified');
    }

    public function showAppointmentLogPage(Request $request){
        $appointment_status = AppointmentStatus::active()->get();
        $appointment_status = AppointmentStatusResource::collection($appointment_status);

        $data = [
            'appointment_status' => $appointment_status,
        ];
        return Inertia::render('AppointmentLog',$data);
    }

}
