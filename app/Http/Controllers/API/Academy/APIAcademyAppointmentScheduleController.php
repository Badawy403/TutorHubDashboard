<?php

namespace App\Http\Controllers\API\Academy;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\Academy\Appointments\AddScheduleRequest;
use App\Http\Requests\API\Academy\Appointments\CreateRequest;
use App\Http\Requests\API\Academy\Appointments\DeleteRequest;
use App\Http\Resources\API\AppointmentSchedulesResource;
use App\Models\AppointmentSchedule;
use App\Models\AppointmentScheduleSlot;
use App\Models\Commission;
use Illuminate\Support\Facades\DB;

class APIAcademyAppointmentScheduleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
        $this->middleware('verified');
        $this->middleware('api_setting');
        $this->middleware('academy.api');
    }
    public function saveAppointmentSchedule(CreateRequest $request)
    {
        try {
            DB::beginTransaction();
            $data = $request->all();
            $user = Auth()->user();
            $academy_id = $user->academy->id;
            $data['academy_id'] = $academy_id;
            if ($request->is_schedule_required) {
                $records = AppointmentSchedule::where('appointment_type_id', $request->appointment_type_id)->get();
                $schedule_ids = $records->pluck('id')->toArray();
                if ($records) {
                    AppointmentScheduleSlot::whereIn('schedule_id', $schedule_ids)->delete();
                    $records->each->delete();
                }

                foreach ($request->selected_days as $key => $day) {
                    $schedule =  AppointmentSchedule::create([
                        'academy_id' => $academy_id,
                        'appointment_type_id' => $request->appointment_type_id,
                        'fee' => $request->fee,
                        'day' => $day,
                        'is_holiday' => isset($request->generated_slots[$day]) ? count($request->generated_slots[$day]) > 0 ? 1 : 0 : 1,
                        'start_time' => $request->start_time,
                        'end_time' => $request->end_time,
                        'slot_duration' => $request->interval,
                    ]);
                    if (isset($request->generated_slots[$day])) {
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
                    }
                }
                $response = generateResponse(null, true, 'Schedules have been added Successfully', null, 'collection');
            } else {
                AppointmentSchedule::where('appointment_type_id', $request->appointment_type_id)->delete();
                if ($request->fee) {
                    $schedule = AppointmentSchedule::create($data);
                    request()->session()->flash('alert', [
                        'type' => 'info',
                        'message' => 'Schedules fee has been added Successfully',
                    ]);
                    $response = generateResponse(null, true, 'Schedules have been added Successfully', null, 'collection');
                } else {
                    $response = generateResponse(null, true, 'Schedules have been added Successfully', null, 'collection');
                }
            }
            DB::commit();
            return response()->json($response, 200);
        } catch (\Exception $e) {
            DB::rollBack();
            $response = generateResponse(null, false, $e->getLine() . $e->getMessage(), null, 'collection');
            return response()->json($response, 200);
        }
    }
    public function getAppointmentSchedules(Request $request)
    {
        try {
            $request->validate([
                'appointment_type_id' => 'required|integer',
                'is_schedule_required' => 'required|integer',
            ]);
            DB::beginTransaction();
            $user = Auth()->user();
            if ($request->is_schedule_required) {
                $schedules = AppointmentSchedule::withAll()->where('academy_id', $user->academy->id)->where('appointment_type_id', $request->appointment_type_id)->get();
                $schedules = AppointmentSchedulesResource::collection($schedules)->keyBy('day');
                $response = generateResponse($schedules, true, "Appointment Schedules Fetched Successfully", null, 'collection');
            } else {
                $schedule = AppointmentSchedule::withAll()->where('academy_id', $user->academy->id)->where('appointment_type_id', $request->appointment_type_id)->first();
                if ($schedule) {
                    $schedule = new AppointmentSchedulesResource($schedule);
                } else {
                    $schedule = null;
                }
                $response = generateResponse($schedule, true, "Appointment Schedule Fetched Successfully", null, 'collection');
            }
            DB::commit();
            return response()->json($response, 200);
        } catch (\Exception $e) {
            DB::rollBack();
            $response = generateResponse(null, false, $e->getMessage(), null, 'collection');
            return response()->json($response, 200);
        }
    }
    public function deleteAppointmentScheduleSlots(DeleteRequest $request)
    {
        try {
            DB::beginTransaction();
            $user = Auth()->user();
            $schedule = AppointmentSchedule::withAll()->where('academy_id', $user->academy->id)->where('appointment_type_id', $request->appointment_type_id)->where('day', $request->day)->first();
            $schedule->schedule_slots()->delete();
            $schedule->delete();
            $response = generateResponse(null, true, 'Schedule slots have been deleted Successfully', null, 'collection');
            DB::commit();
            return response()->json($response, 200);
        } catch (\Exception $e) {
            DB::rollBack();
            $response = generateResponse(null, false, $e->getMessage(), null, 'collection');
            return response()->json($response, 200);
        }
    }
    public function addNewAppointmentSchedule(AddScheduleRequest $request)
    {
        try {
            DB::beginTransaction();
            $user = Auth()->user();
            $academy_id = $user->academy->id;
            $schedule = AppointmentSchedule::withAll()->where('academy_id', $academy_id)->where('appointment_type_id', $request->appointment_type_id)->first();
            $created = AppointmentSchedule::create([
                'academy_id' => $academy_id,
                'appointment_type_id' => $request->appointment_type_id,
                'fee' => $schedule->fee,
                'day' => $request->day,
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
            $response = generateResponse($created, true, 'Schedules have been added Successfully', null, 'collection');
            DB::commit();
            return response()->json($response, 200);
        } catch (\Exception $e) {
            DB::rollBack();
            $response = generateResponse(null, false, $e->getMessage(), null, 'collection');
            return response()->json($response, 200);
        }
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
