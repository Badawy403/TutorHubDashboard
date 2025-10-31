<?php

namespace App\Http\Resources\API;

use App\Http\Resources\Web\StudentsResource;
use Illuminate\Http\Resources\Json\JsonResource;

class TeacherMainCategoriesResource extends JsonResource
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
        $categories = $this->relationLoaded('categories') ? $this->whenLoaded('categories'):null;
        $archive_count = 0;
        $student_count = 0;
        $teacher_count = 0;
        if ($categories) {
            $teacher_count = $categories->sum('teachers_count');
            $archive_count = $categories->sum(function($category) {
                return $category->teachers->sum('teacher_archives_count');
            });
        }

        return [
                "id" =>  $this->id,
                "name" =>  $this->name,
                "description" =>  $this->description,
                "teacher_count" =>  $teacher_count,
                "student_count" =>  $student_count,
                "archive_count" =>  $archive_count,
                "slug" =>  $this->slug,
                "is_active" =>  $this->is_active,
                "is_featured" =>  $this->is_featured,
                "icon" =>  $this->icon,
                "image" =>  $this->image,
                "categories" =>  TeacherCategoriesResource::collection($this->whenLoaded('categories')),
                "created_at" =>  $this->created_at,
                "updated_at" =>  $this->updated_at,
        ];
    }
}
