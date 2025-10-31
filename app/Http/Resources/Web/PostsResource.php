<?php

namespace App\Http\Resources\Web;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class PostsResource extends JsonResource
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
        $tags = $this->relationLoaded('tags') ? $this->whenLoaded('tags') : null;
        $academy = $this->relationLoaded('academy') ? $this->whenLoaded('academy') : null;
        $teacher = $this->relationLoaded('teacher') ? $this->whenLoaded('teacher') : null;
        $blog_category = $this->relationLoaded('blog_category') ? $this->whenLoaded('blog_category') : null;
        return [
            "id" =>  $this->id,
            'teacher_id' => $this->teacher_id,
            'teacher_name' => $teacher ? $teacher->name : "",
            'academy_id' => $this->academy_id,
            'academy_name' => $academy ? $academy->name : "",
            "tag_ids" => $tags ? TagsResource::collection($this->whenLoaded('tags', function () {
                return $this->tags;
            }))->pluck('id')->toArray() : [],
            "tags" => $tags ? TagsResource::collection($tags) : [],
            'blog_category_id' => $this->blog_category_id,
            'blog_category_name' => $blog_category ? $blog_category->name : "",
            'blog_category_slug' => $blog_category ? $blog_category->slug : "",
            "name" =>  $this->name,
            "name_translations" => $this->getTranslations('name'),
            "description" =>  $this->description,
            "description_translations" =>  $this->getTranslations('description'),

            "slug" =>  $this->slug,
            "is_active" =>  $this->is_active,
            "is_featured" =>  $this->is_featured,
            "icon" =>  $this->icon,
            "image" =>  $this->image,
            "created_at" =>  Carbon::parse($this->created_at)->format('Y-m-d'),
            "updated_at" =>  $this->updated_at,
        ];
    }
}
