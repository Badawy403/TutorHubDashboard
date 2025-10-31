<?php

namespace App\Http\Controllers\Teachers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Http\Controllers\Controller;
use App\Http\Resources\Web\AppointmentSchedulesResource;
use App\Http\Resources\Web\AppointmentTypesResource;
use App\Http\Resources\Web\TeachersResource;
use App\Models\AppointmentSchedule;
use App\Models\AppointmentType;
use App\Models\BookAppointment;
use App\Models\Gateway;
use App\Models\Teacher;

class TeacherProfileController extends Controller
{
    public function __construct()
    {

    }

    public function myProfile(Request $request)
    {
        $user = auth()->user();
        $teacher = $user->teacher;
        $teacher = Teacher::withChildrens()->active()->withAll()->where('id', $teacher->id)->first();
        if (!$teacher) {
            abort(404);
        }
        $teacher = new TeachersResource($teacher);
        $appointment_types = AppointmentType::active()->get();
        $appointment_types = AppointmentTypesResource::collection($appointment_types);
        return Inertia::render('Teachers/Profile', [
            'teacher' => $teacher,
            'appointment_types' => $appointment_types
        ]);
    }
    public function profile(Request $request)
    {
        $teacher = Teacher::withChildrens()->active()->approved()->withAll()->where('user_name', $request->user_name)->first();
        if (!$teacher) {
            abort(404);
        }
        $teacher = new TeachersResource($teacher);
        $appointment_types = AppointmentType::active()->get();
        $appointment_types = AppointmentTypesResource::collection($appointment_types);
        return Inertia::render('Teachers/Profile', [
            'teacher' => $teacher,
            'appointment_types' => $appointment_types
        ]);
    }

    public function reviews(Request $request)
    {
        $teacher = Teacher::withChildrens()->active()->approved()->withAll()->where('user_name', $request->user_name)->first();
        if (!$teacher) {
            abort(404);
        }
        $teacher = new TeachersResource($teacher);
        return Inertia::render('Teachers/Reviews', [
            'teacher' => $teacher
        ]);
    }

    public function bookAppointment(Request $request, $user_name)
    {
        $teacher = Teacher::where('user_name', $user_name)->first();
        $teacher_id = $teacher->id;
        $appointment_type = AppointmentType::select('id', 'is_schedule_required')->where('type', $request->type)->first();
        $appointment_type_id = $appointment_type->id;
        $day = strtolower(Date('l'));
        $date = today();
        if ($appointment_type->is_schedule_required) {
            $schedule = AppointmentSchedule::with('appointment_type')->with('schedule_slots')->where('teacher_id', $teacher_id)->where('appointment_type_id', $appointment_type_id)->where('day', $day)->first();
        } else {
            $schedule = AppointmentSchedule::with('appointment_type')->with('schedule_slots')->where('teacher_id', $teacher_id)->where('appointment_type_id', $appointment_type_id)->first();
        }
        if ($schedule) {
            $scheduleSlots = $schedule->schedule_slots;
            if (count($scheduleSlots) > 0) {
                foreach ($scheduleSlots as $scheduleSlot) {
                    $is_disabled = BookAppointment::where('teacher_id', $teacher_id)
                    ->whereDate('date', $date)
                    ->where('is_paid', 1)
                    ->where(function ($q) use ($scheduleSlot) {
                        $q->where(function ($z) use ($scheduleSlot) {
                            $z->where('start_time',$scheduleSlot->start_time);
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
        $gateways = Gateway::where('status', 1)->orderBy('sort_by', 'ASC')->get();

        // dd($gateways);

        return Inertia::render('Teachers/BookAppointment', [
            'schedule' => $schedule,
            'teacher_id' => $teacher_id,
            'teacher' => $teacher,
            'appointment_type_name' => $appointment_type->display_name,
            'appointment_type_id' => $appointment_type_id,
            'is_schedule_required' => $appointment_type->is_schedule_required,
            "gateways" => $gateways
        ]);
    }
}
