<?php

namespace App\Http\Resources\API;

use Illuminate\Http\Resources\Json\JsonResource;

class AcademyReviewsResource extends JsonResource
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
        return [
                "id" =>  $this->id,
                "rating" =>  $this->rating,
                "experience" =>  $this->experience,
                "communication" =>  $this->communication,
                "service" =>  $this->service,
                "comment" =>  $this->comment,
                "is_active" =>  $this->is_active,
                "student" =>[
                    "name" => $student->name ?? '',
                    "image" => $student->image ?? '',
                ],
                "created_at" =>  $this->created_at,
                "updated_at" =>  $this->updated_at,
        ];
    }
}
