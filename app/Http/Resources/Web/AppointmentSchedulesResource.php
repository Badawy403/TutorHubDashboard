<?php

namespace App\Http\Resources\Web;

use App\Models\AppointmentType;
use Illuminate\Http\Resources\Json\JsonResource;

class AppointmentSchedulesResource extends JsonResource
{
    public static $wrap = null;
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
        /**
     * Indicates if the resource's collection keys should be preserved.
     *
     * @var bool
     */
    public $preserveKeys = true;
    public function toArray($request)
    {
        $schedule_slots = $this->relationLoaded('schedule_slots') ? $this->whenLoaded('schedule_slots'):null;
        $appointment_type = $this->relationLoaded('appointment_type') ? $this->whenLoaded('appointment_type'):null;
        return [
                "id" =>  $this->id,
                "teacher_id" =>  $this->teacher_id,
                "academy_id" =>  $this->academy_id,
                "appointment_type_id" =>  $this->appointment_type_id,
                "fee" =>  $this->fee,
                "day" =>  $this->day,
                "is_holiday" =>  $this->is_holiday,
                "start_time" =>  $this->start_time,
                "end_time" =>  $this->end_time,
                "slot_duration" =>  $this->slot_duration,
                'type' => $appointment_type?$appointment_type->type:'',
                "appointment_type" => $appointment_type ? new AppointmentTypesResource($appointment_type):null,
                "schedule_slots" => $schedule_slots ? AppointmentScheduleSlotsResource::collection($schedule_slots):[],
                "created_at" =>  $this->created_at,
                "updated_at" =>  $this->updated_at,
        ];
    }
}
