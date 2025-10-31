<?php

namespace App\Http\Resources\API;

use Illuminate\Http\Resources\Json\JsonResource;

class AppointmentScheduleSlotsResource extends JsonResource
{
    public static $wrap = null;
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
                "id" =>  $this->id,
                "schedule_id" =>  $this->schedule_id,
                "start_time" =>  $this->start_time,
                "end_time" =>  $this->end_time,
                "is_disabled" =>  $this->is_disabled,
                "is_active" =>  $this->is_active,
                "created_at" =>  $this->created_at,
                "updated_at" =>  $this->updated_at,
        ];
    }
}
