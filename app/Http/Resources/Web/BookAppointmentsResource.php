<?php

namespace App\Http\Resources\Web;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class BookAppointmentsResource extends JsonResource
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
        $appointment_status = $this->relationLoaded('appointment_status') ? $this->whenLoaded('appointment_status') : null;
        $appointment_type = $this->relationLoaded('appointment_type') ? $this->whenLoaded('appointment_type') : null;
        $messages = $this->relationLoaded('messages') ? $this->whenLoaded('messages') : null;
        $fund = $this->relationLoaded('fund') ? $this->whenLoaded('fund') : null;

        return [
            "id" =>  $this->id,
            "student_id" =>  $this->student_id,
            "student_name" => $student ? $student->name : null,
            "student_image" => $student ? $student->image : null,
            "appointment_status_name" => $appointment_status ? $appointment_status->display_name : null,
            "appointment_type_name" => $appointment_type ? $appointment_type->display_name : null,
            "is_schedule_required" => $appointment_type->is_schedule_required ? 1 : 0,
            "teacher_id" =>  $this->teacher_id,
            "teacher_name" => $teacher ? $teacher->name : null,
            "teacher_image" => $teacher ? $teacher->image : null,
            "teacher_cover_image" => $teacher ? $teacher->cover_image : null,
            'ratings'=> AppointmentRatingsResource::collection($this->whenLoaded('ratings')),
            "academy_id" =>  $this->academy_id,
            "academy_name" => $academy->name ?? null,
            "academy_image" => $academy->image ?? null,
            "academy_cover_image" => $academy->cover_image ?? null,
            "date" => Carbon::parse($this->date)->format('d/m/Y'),
            "start_time" =>  $this->start_time,
            "end_time" =>  $this->end_time,
            "fee" =>  $this->fee,
            "is_paid" =>  $this->is_paid,
            "appointment_type_id" =>  $this->appointment_type_id,
            "appointment_type" =>  $this->appointment_type->type,
            "question" =>  $this->question,
            "attachment_url" =>  $this->attachment_url,
            "appointment_status_code" =>  $this->appointment_status_code,
            "messages" => $messages ? MessagesResource::collection($messages):[],
            "is_started" => $this->is_started,
            "fund" => $fund ? $fund : null,
            "is_ended" => $this->is_ended,
            "started_at" => $this->started_at,
            "ended_at" => $this->ended_at,
            "created_at" =>  $this->created_at,
            "updated_at" =>  $this->updated_at,
        ];
    }
}
