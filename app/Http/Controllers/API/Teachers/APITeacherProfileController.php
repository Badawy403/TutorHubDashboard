<?php

namespace App\Http\Controllers\API\Teachers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\API\AppointmentSchedulesResource;
use App\Http\Resources\API\AppointmentTypesResource;
use App\Http\Resources\API\TeachersResource;
use App\Models\AppointmentSchedule;
use App\Models\AppointmentType;
use App\Models\BookAppointment;
use App\Models\Teacher;
use Carbon\Carbon;

class APITeacherProfileController extends Controller
{
    public function __construct()
    {
    }

    public function bookAppointment(Request $request, $user_name)
    {
        try {
            $request->validate([
                'appointment_type_id' => 'required|exists:appointment_types,id',
                'date' => 'required|date',
            ]);
            $teacher = Teacher::where('user_name', $user_name)->first();
            if (!$teacher) {
                $response = generateResponse(null, false, 'Teacher Not Found', null, 'collection');
                return response()->json($response, 404);
            }
            $teacher_id = $teacher->id;
            $appointment_type = AppointmentType::select('id', 'is_schedule_required')->where('id', $request->appointment_type_id)->first();
            $day = Carbon::parse($request->date)->format('l');
            if ($appointment_type->is_schedule_required) {
                $schedule = AppointmentSchedule::with('appointment_type')->with('schedule_slots')->where('teacher_id', $teacher_id)->where('appointment_type_id', $appointment_type->id)->where('day', $day)->first();
            } else {
                $schedule = AppointmentSchedule::with('appointment_type')->with('schedule_slots')->where('teacher_id', $teacher_id)->where('appointment_type_id', $appointment_type->id)->first();
            }
            if ($schedule) {
                $scheduleSlots = $schedule->schedule_slots;
                if (count($scheduleSlots) > 0) {
                    foreach ($scheduleSlots as $scheduleSlot) {
                        $is_disabled = BookAppointment::where('teacher_id', $teacher_id)
                            ->whereDate('date', $request->date)
                            ->where('is_paid', 1)
                            ->where(function ($q) use ($scheduleSlot) {
                                $q->where(function ($z) use ($scheduleSlot) {
                                    $z->where('start_time', $scheduleSlot->start_time);
                                    $z->where('end_time', $scheduleSlot->end_time);
                                });
                            })->count();

                        $scheduleSlot['is_disabled'] = $is_disabled;
                    }
                }
                $schedule = new AppointmentSchedulesResource($schedule);
            } else {
                $schedule = null;
            }
            $data['schedule'] = $schedule;
            $response = generateResponse($data, true, 'Data Featch Successfully', null, 'collection');
            return response()->json($response, 200);
        } catch (\Exception $e) {
            $response = generateResponse(null, false, $e->getMessage(), null, 'collection');
            return response()->json($response, 200);
        }
    }

    public function getLwyerAppointmentTypes(Request $request, $user_name)
    {
        try {
            $teacher = Teacher::withAll()->where('user_name', $user_name)->first();
            if (!$teacher) {
                $response = generateResponse(null, false, 'Teacher Not Found', null, 'collection');
                return response()->json($response, 404);
            }
            $appointment_types = $teacher->appointment_schedules()->pluck('appointment_type_id')->toArray();
            $appointment_types = AppointmentType::whereIn('id', array_unique($appointment_types))->active()->get();
            $appointment_types = AppointmentTypesResource::collection($appointment_types);
            $response = generateResponse($appointment_types, true, 'Data Featch Successfully', null, 'collection');
            return response()->json($response, 200);
        } catch (\Exception $e) {
            $response = generateResponse(null, false, $e->getMessage(), null, 'collection');
            return response()->json($response, 200);
        }
    }
}
