<?php

namespace App\Http\Resources\API;

use Illuminate\Http\Resources\Json\JsonResource;

class TeacherSettingsResource extends JsonResource
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
            "teacher_id" => $this->teacher_id,
            "name" => $this->name,
            "display_name" => $this->display_name,
            "value" => $this->value,
            "is_specific" => $this->is_specific,
            "type" => $this->type,
            "page" => $this->page,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at
        ];
    }
}
