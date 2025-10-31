<?php

namespace App\Http\Resources\Web;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class BookedServicesResource extends JsonResource
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
        $student = $this->relationLoaded('student') ? $this->whenLoaded('student') : null;
        $teacher = $this->relationLoaded('teacher') ? $this->whenLoaded('teacher') : null;
        $academy = $this->relationLoaded('academy') ? $this->whenLoaded('academy') : null;
        $service = $this->relationLoaded('service') ? $this->whenLoaded('service') : null;
        $service_status = $this->relationLoaded('service_status') ? $this->whenLoaded('service_status') : null;
        $messages = $this->relationLoaded('messages') ? $this->whenLoaded('messages') : null;
        $reviews = $this->relationLoaded('reviews') ? $this->whenLoaded('reviews') : null;
        return [
            "id" =>  $this->id,
            "student_id" =>  $this->student_id,
            "student_name" => $student ? $student->name : null,
            "student_image" => $student ? $student->image : null,
            "teacher_id" =>  $this->teacher_id,
            "teacher_name" => $teacher ? $teacher->name : null,
            "teacher_image" => $teacher ? $teacher->image : null,
            "academy_id" =>  $this->academy_id,
            "academy_name" => $academy ? $academy->name : null,
            "academy_image" => $academy ? $academy->image : null,
            "service_id" =>  $this->service_id,
            "service_name" => $service ? $service->name : null,
            "service_image" => $service ? $service->image : null,
            "service_status_name" => $service_status ? $service_status->display_name : null,
            "date" => Carbon::parse($this->date)->format('d/m/Y'),
            "started_at" =>  $this->started_at,
            "ended_at" =>  $this->ended_at,
            "price" =>  $this->price,
            "is_paid" =>  $this->is_paid,
            "question" =>  $this->question,
            "attachment_url" =>  $this->attachment_url,
            "service_status_code" =>  $this->service_status_code,
            "messages" => $messages ? MessagesResource::collection($messages):[],
            "reviews" => $reviews ? ServiceReviewsResource::collection($reviews):[],
            "created_at" =>  $this->created_at,
            "updated_at" =>  $this->updated_at,
        ];
    }
}
