<?php

namespace App\Http\Resources\Web;

use Illuminate\Http\Resources\Json\JsonResource;

class AppointmentRatingsResource extends JsonResource
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
                "booked_appointment_id" =>  $this->booked_appointment_id,
                "fromable_id" =>  $this->fromable_id,
                "fromable_type" =>  $this->from_able_type,
                "to_id" =>  $this->to_id,
                "to_type" =>  $this->to_able_type,
                "rating" =>  $this->rating,
                "comment" =>  $this->comment,
                "created_at" =>  $this->created_at,
                "updated_at" =>  $this->updated_at,
        ];
    }
}
