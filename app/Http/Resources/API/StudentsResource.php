<?php

namespace App\Http\Resources\API;

use Illuminate\Http\Resources\Json\JsonResource;

class StudentsResource extends JsonResource
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
                "id" => $this->id,
                "user_id" => $this->user_id,
                "country_id" => $this->country_id,
                "state_id" => $this->state_id,
                "city_id" => $this->city_id,
                "name" => $this->name,
                "first_name" => $this->first_name,
                "last_name" => $this->last_name,
                "user_name" => $this->user_name,
                "description" => $this->description,
                "address_line_1" => $this->address_line_1,
                "address_line_2" => $this->address_line_2,
                "user_name" => $this->user_name,
                "zip_code" => $this->zip_code,
                "is_approved" => $this->is_approved,
                "approved_at" => $this->approved_at,
                "is_active" => $this->is_active,
                "is_featured" => $this->is_featured,
                "icon" => $this->icon,
                "image" => $this->image,
                "cover_image" => $this->cover_image,
                "created_at" => $this->created_at,
                "updated_at" => $this->updated_at,
        ];
    }
}
