<?php

namespace App\Http\Controllers\Academies;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Http\Controllers\Controller;
use App\Http\Resources\Web\AppointmentSchedulesResource;
use App\Http\Resources\Web\AppointmentTypesResource;
use App\Http\Resources\Web\AcademiesResource;
use App\Models\AppointmentSchedule;
use App\Models\AppointmentType;
use App\Models\BookAppointment;
use App\Models\Gateway;
use App\Models\Academy;

class AcademyProfileController extends Controller
{
    public function __construct()
    {
    }

    public function myProfile(Request $request)
    {
        $user = auth()->user();
        $academy = $user->academy;
        $academy = Academy::withChildrens()->active()->withAll()->where('id', $academy->id)->first();
        if (!$academy) {
            abort(404);
        }
        $academy = new AcademiesResource($academy);
        $appointment_types = AppointmentType::active()->get();
        $appointment_types = AppointmentTypesResource::collection($appointment_types);
        return Inertia::render('Academies/Profile', [
            'academy' => $academy,
            'appointment_types' => $appointment_types
        ]);
    }
    public function profile(Request $request)
    {
        $academy = Academy::withChildrens()->active()->approved()->withAll()->where('user_name', $request->user_name)->first();

        if (!$academy) {
            abort(404);
        }
        $academy->setRelation(
            'academy_teachers',
            $academy->academy_teachers->take(20)
        );
        $academy = new AcademiesResource($academy);
        $appointment_types = AppointmentType::active()->get();
        $appointment_types = AppointmentTypesResource::collection($appointment_types);
        return Inertia::render('Academies/Profile', [
            'academy' => $academy,
            'appointment_types' => $appointment_types

        ]);
    }

    public function reviews(Request $request)
    {
        $academy = Academy::withChildrens()->active()->approved()->withAll()->where('user_name', $request->user_name)->first();
        if (!$academy) {
            abort(404);
        }
        $academy = new AcademiesResource($academy);
        return Inertia::render('Academies/Reviews', [
            'academy' => $academy
        ]);
    }
    public function bookAppointment(Request $request, $user_name)
    {
        $academy = Academy::where('user_name', $user_name)->first();
        $academy_id = $academy->id;
        $appointment_type = AppointmentType::select('id', 'is_schedule_required')->where('type', $request->type)->first();
        $appointment_type_id = $appointment_type->id;
        $day = strtolower(Date('l'));
        $date = today();
        if ($appointment_type->is_schedule_required) {
            $schedule = AppointmentSchedule::with('appointment_type')->with('schedule_slots')->where('academy_id', $academy_id)->where('appointment_type_id', $appointment_type_id)->where('day', $day)->first();
        } else {
            $schedule = AppointmentSchedule::with('appointment_type')->with('schedule_slots')->where('academy_id', $academy_id)->where('appointment_type_id', $appointment_type_id)->first();
        }
        if ($schedule) {
            $scheduleSlots = $schedule->schedule_slots;
            if (count($scheduleSlots) > 0) {
                foreach ($scheduleSlots as $scheduleSlot) {
                    $is_disabled = BookAppointment::where('academy_id', $academy_id)
                        ->whereDate('date', $date)
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
        $gateways = Gateway::where('status', 1)->orderBy('sort_by', 'ASC')->get();

        return Inertia::render('Academies/BookAppointment', [
            'schedule' => $schedule,
            'academy_id' => $academy_id,
            'academy' => $academy,
            'appointment_type_name' => $appointment_type->display_name,
            'appointment_type_id' => $appointment_type_id,
            'is_schedule_required' => $appointment_type->is_schedule_required,
            "gateways" => $gateways

        ]);
    }
}
