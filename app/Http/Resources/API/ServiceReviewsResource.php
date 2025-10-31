<?php

namespace App\Http\Resources\API;

use Illuminate\Http\Resources\Json\JsonResource;

class ServiceReviewsResource extends JsonResource
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
        $student = $this->relationLoaded('student') ? $this->whenLoaded('student'):null;
        $teacher = $this->relationLoaded('teacher') ? $this->whenLoaded('teacher'):null;
        $academy = $this->relationLoaded('academy') ? $this->whenLoaded('academy'):null;
        $service = $this->relationLoaded('service') ? $this->whenLoaded('service'):null;
        return [
                "id" =>  $this->id,
                "rating" =>  $this->rating,
                "experience" =>  $this->experience,
                "communication" =>  $this->communication,
                "service" =>  $this->service,
                "comment" =>  $this->comment,
                "is_active" =>  $this->is_active,
                "student" =>[
                    "id" => $student->id ?? '',
                    "name" => $student->name ?? '',
                    "image" => $student->image ?? '',
                ],
                "academy" =>[
                    "id" => $academy->id ?? '',
                    "name" => $academy->name ?? '',
                    "image" => $academy->image ?? '',
                ],
                "teacher" =>[
                    "id" => $teacher->id ?? '',
                    "name" => $teacher->name ?? '',
                    "image" => $teacher->image ?? '',
                ],
                "created_at" =>  $this->created_at,
                "updated_at" =>  $this->updated_at,
        ];
    }
}
