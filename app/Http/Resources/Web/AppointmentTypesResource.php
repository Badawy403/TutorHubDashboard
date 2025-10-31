<?php

namespace App\Http\Resources\Web;

use Illuminate\Http\Resources\Json\JsonResource;

class AppointmentTypesResource extends JsonResource
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
                "display_name" =>  $this->display_name,
                "description" =>  $this->description,
                "type" =>  $this->type,
                "is_schedule_required" =>  $this->is_schedule_required,
                "is_paid" =>  $this->is_paid,
                "is_active" =>  $this->is_active,
                "created_at" =>  $this->created_at,
                "updated_at" =>  $this->updated_at,
        ];
    }
}
