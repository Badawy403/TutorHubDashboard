<?php

namespace App\Http\Resources\API;

use Illuminate\Http\Resources\Json\JsonResource;

class TeachersResource extends JsonResource
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
        $teacher_settings = $this->relationLoaded('teacher_settings') ? $this->whenLoaded('teacher_settings') : null;
        $teacher_categories = $this->relationLoaded('teacher_categories') ? $this->whenLoaded('teacher_categories') : null;
        $teacher_reviews = $this->relationLoaded('teacher_reviews') ? $this->whenLoaded('teacher_reviews') : null;
        $pricing_plan = $this->relationLoaded('pricing_plan') ? $this->whenLoaded('pricing_plan') : null;
        $appointment_schedules = $this->relationLoaded('appointment_schedules') ? $this->whenLoaded('appointment_schedules') : null;

        if ($teacher_reviews) {
            $rating = $teacher_reviews->avg('rating');
            if (!$rating) {
                $rating = 0;
            } else {
                $rating = round($rating, 2);
            }
        } else {
            $rating = 0;
        }
        return [
            "id" => $this->id,
            "user_id" => $this->user_id,
            "country_id" => $this->country_id,
            "state_id" => $this->state_id,
            "city_id" => $this->city_id,
            "name" => $this->name,
            "first_name" => $this->first_name,
            "last_name" => $this->last_name,
            "description" => $this->description,
            "description_translations" =>  $this->getTranslations('description'),
            "address_line_1" => $this->address_line_1,
            "address_line_2" => $this->address_line_2,
            "user_name" => $this->user_name,
            "zip_code" => $this->zip_code,
            "is_approved" => $this->is_approved,
            "approved_at" => $this->approved_at,
            "is_active" => $this->is_active,
            "is_online" => $this->is_online,
            "is_featured" => $this->is_featured,
            "icon" => $this->icon,
            "image" => $this->image,
            "cover_image" => $this->cover_image,
            "rating" => $rating,
            "teacher_settings" => isset($teacher_settings) && count($teacher_settings) > 0 ? TeacherSettingsResource::collection($this->whenLoaded('teacher_settings', function () {
                return $this->teacher_settings;
            }))->pluck('value', 'name')->toArray() : null,
            "teacher_category_ids" => isset($teacher_categories) && count($teacher_categories) > 0 ? TeacherCategoriesResource::collection($this->whenLoaded('teacher_categories', function () {
                return $this->teacher_categories;
            }))->pluck('id')->toArray() : null,
            "appointment_types" =>  $appointment_schedules ? AppointmentSchedulesResource::collection($appointment_schedules)->keyBy('appointment_type.type') : [],
            "teacher_categories" => $teacher_categories ? TeacherCategoriesResource::collection($teacher_categories) : [],
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
        ];
    }
}
