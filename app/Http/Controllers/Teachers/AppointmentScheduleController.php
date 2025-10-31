<?php

namespace App\Http\Controllers\Teachers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Http\Controllers\Controller;
use App\Http\Requests\Teachers\Appointments\AddScheduleRequest;
use App\Http\Resources\Web\TeachersResource;
use App\Http\Requests\Teachers\Appointments\CreateRequest;
use App\Http\Requests\Teachers\Appointments\DeleteRequest;
use App\Http\Resources\Web\AppointmentSchedulesResource;
use App\Models\AppointmentSchedule;
use App\Models\AppointmentScheduleSlot;
use App\Models\Commission;

class AppointmentScheduleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('teacher');
    }
    public function saveAppointmentSchedule(CreateRequest $request)
    {
        $data = $request->all();
        $user = Auth()->user();
        $teacher_id = $user->teacher->id;
        $data['teacher_id'] = $teacher_id;
        $general_settings = generalSettings();
        if ($general_settings['commission_type'] == 'commission_base') {
            $commission = Commission::where('appointment_type_id', $request->appointment_type_id)->first();
            if ($commission && $commission->commission_type == 'fixed_rate') {
                $commission_amount = $commission->rate;
                $final_amount = $request->fee + $commission->rate;
            } else {
                $percentage_value = ($request->fee / 100) * $commission->rate;
                $commission_amount = $percentage_value;
                $final_amount = $request->fee + $percentage_value;
            }
        } else {
            $final_amount = $request->fee;
            $commission_amount = null;
        }
        if ($request->is_schedule_required) {
            $records = AppointmentSchedule::where('teacher_id', $teacher_id)->where('appointment_type_id', $request->appointment_type_id)->get();
            $schedule_ids = $records->pluck('id')->toArray();
            if ($records) {
                AppointmentScheduleSlot::whereIn('schedule_id', $schedule_ids)->delete();
                $records->each->delete();
            }

            foreach ($request->selected_days as $key => $day) {

                $schedule =  AppointmentSchedule::create([
                    'teacher_id' => $teacher_id,
                    'appointment_type_id' => $request->appointment_type_id,
                    'fee' => $final_amount,
                    'commission_amont' => $commission_amount,
                    'day' => $day,
                    'is_holiday' => count($request->generated_slots[$day]) > 0 ? 1 : 0,
                    'start_time' => $request->start_time,
                    'end_time' => $request->end_time,
                    'slot_duration' => $request->interval,
                ]);
                foreach ($request->generated_slots[$day] as $key => $slot) {
                    AppointmentScheduleSlot::create(
                        [
                            'schedule_id' => $schedule->id,
                            'start_time' => $slot['start_time'],
                            'end_time' => $slot['end_time'],
                            'is_active' => $slot['is_active'],
                        ]
                    );
                }
                request()->session()->flash('alert', [
                    'type' => 'info',
                    'message' => 'Schedules have been added Successfully',
                ]);
            }
        } else {
            AppointmentSchedule::where('teacher_id', $teacher_id)->where('appointment_type_id', $request->appointment_type_id)->delete();
            if ($request->fee) {
                $data['commission_amont'] = $commission_amount;
                $data['fee'] = $final_amount;
                AppointmentSchedule::create($data);
                request()->session()->flash('alert', [
                    'type' => 'info',
                    'message' => 'Schedules fee has been added Successfully',
                ]);
            }
            else
            {
                request()->session()->flash('alert', [
                    'type' => 'info',
                    'message' => 'Schedule has been deleted Successfully',
                ]);
            }
        }
    }
    public function getAppointmentSchedules(Request $request)
    {
        $request->validate([
            'appointment_type_id' => 'required|integer',
            'is_schedule_required' => 'required|integer',
        ]);
        $user = Auth()->user();

        if ($request->is_schedule_required) {
            $schedules = AppointmentSchedule::withAll()->where('teacher_id', $user->teacher->id)->where('appointment_type_id', $request->appointment_type_id)->get();
            $schedules = AppointmentSchedulesResource::collection($schedules)->keyBy('day');
            $response = generateResponse($schedules, true, "Appointment Schedules Fetched Successfully", null, 'collection');
            return response()->json($response);
        } else {
            $schedule = AppointmentSchedule::withAll()->where('teacher_id', $user->teacher->id)->where('appointment_type_id', $request->appointment_type_id)->first();
            if ($schedule) {
                $schedule = new AppointmentSchedulesResource($schedule);
            } else {
                $schedule = null;
            }
            $response = generateResponse($schedule, true, "Appointment Schedule Fetched Successfully", null, 'collection');
            return response()->json($response);
        }
    }
    public function deleteAppointmentScheduleSlots(DeleteRequest $request)
    {
        $user = Auth()->user();
        $schedule = AppointmentSchedule::withAll()->where('teacher_id', $user->teacher->id)->where('appointment_type_id', $request->appointment_type_id)->where('day', $request->day)->first();
        $schedule->schedule_slots()->delete();
        $schedule->delete();
        request()->session()->flash('alert', [
            'type' => 'info',
            'message' => 'Schedule slots have been deleted Successfully',
        ]);
        return redirect()->back();
    }
    public function addNewAppointmentSchedule(AddScheduleRequest $request)
    {
        $user = Auth()->user();
        $teacher_id = $user->teacher->id;
        $general_settings = generalSettings();
        $schedule = AppointmentSchedule::withAll()->where('teacher_id', $teacher_id)->where('appointment_type_id', $request->appointment_type_id)->first();
        if ($general_settings['commission_type'] == 'commission_base') {
            $commission = Commission::where('appointment_type_id', $request->appointment_type_id)->first();
            if ($commission && $commission->commission_type == 'fixed_rate') {
                $commission_amount = $commission->rate;
            } else {
                $percentage_value = ($schedule->fee / 100) * $commission->rate;
                $commission_amount = $percentage_value;
            }
        } else {
            $commission_amount = null;
        }
        $created = AppointmentSchedule::create([
            'teacher_id' => $teacher_id,
            'appointment_type_id' => $request->appointment_type_id,
            'fee' => $schedule->fee,
            'day' => $request->day,
            'commission_amont' => $commission_amount,
            'is_holiday' => count($request->generated_slots) > 0 ? 1 : 0,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'slot_duration' => $request->interval,
        ]);
        foreach ($request->generated_slots as $key => $slot) {
            AppointmentScheduleSlot::create(
                [
                    'schedule_id' => $created->id,
                    'start_time' => $slot['start_time'],
                    'end_time' => $slot['end_time'],
                    'is_active' => $slot['is_active'],
                ]
            );
        }
        request()->session()->flash('alert', [
            'type' => 'info',
            'message' => 'Schedule has been deleted Successfully',
        ]);
        return redirect()->back();
    }
    public function getAppointmentCommission(Request $request)
    {
        $request->validate([
            'appointment_type_id' => 'required|integer',
        ]);
        $user = Auth()->user();

        $commission = Commission::where('appointment_type_id', $request->appointment_type_id)->first();
        $response = generateResponse($commission, true, "Commission Fetched Successfully", null, 'collection');
        return response()->json($response);
    }
}
