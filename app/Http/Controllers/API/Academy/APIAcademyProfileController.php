<?php

namespace App\Http\Controllers\API\Academy;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Web\AppointmentSchedulesResource;
use App\Models\AppointmentSchedule;
use App\Models\AppointmentType;
use App\Models\Teacher;

class APIAcademyProfileController extends Controller
{
    public function __construct()
    {
    }

    public function bookAppointment(Request $request, $user_name)
    {
     try{
        $request->validate([
            'appointment_type_id' => 'required|exists:appointment_types,id',
        ]);
        $teacher = Teacher::where('user_name', $user_name)->first();
        if(!$teacher){
        $response = generateResponse(null, false, 'Teacher Not Found', null, 'collection');
        return response()->json($response, 404); 
        }
        $teacher_id = $teacher->id;
        $appointment_type = AppointmentType::select('id','is_schedule_required')->where('id', $request->appointment_type_id)->first();
        $day = strtolower(Date('l'));
        if ($appointment_type->is_schedule_required) {
            $schedule = AppointmentSchedule::with('appointment_type')->with('schedule_slots')->where('teacher_id', $teacher_id)->where('appointment_type_id', $appointment_type->id)->where('day', $day)->first();
        } else {
            $schedule = AppointmentSchedule::with('appointment_type')->with('schedule_slots')->where('teacher_id', $teacher_id)->where('appointment_type_id', $appointment_type->id)->first();
        }
        if ($schedule) {
            $schedule = new AppointmentSchedulesResource($schedule);
        } else {
            $schedule = null;
        }
        $data['schedule'] = $schedule;
        $data['teacher_id'] = $teacher_id;
        $data['teacher'] = $teacher;
        $data['appointment_type'] = $appointment_type;
        $response = generateResponse($data, false, 'Data Featch Successfully', null, 'collection');
        return response()->json($response, 200);
    }
    catch (\Exception $e) {
    $response = generateResponse(null, false, $e->getMessage(), null, 'collection');
    return response()->json($response, 200);
    } 
  }
}
