<?php

namespace App\Http\Resources\API;

use Illuminate\Http\Resources\Json\JsonResource;

class AcademiesResource extends JsonResource
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
        $academy_settings = $this->relationLoaded('academy_settings') ? $this->whenLoaded('academy_settings'):null;
        $academy_categories = $this->relationLoaded('academy_categories') ? $this->whenLoaded('academy_categories'):null;
        $academy_teachers = $this->relationLoaded('academy_teachers') ? $this->whenLoaded('academy_teachers') : null;
        $academy_reviews = $this->relationLoaded('academy_reviews') ? $this->whenLoaded('academy_reviews'):null;
        $pricing_plan = $this->relationLoaded('pricing_plan') ? $this->whenLoaded('pricing_plan'):null;
        $appointments = $this->relationLoaded('appointments') ? $this->whenLoaded('appointments'):null;

        if($academy_reviews){
            $rating = $academy_reviews->avg('rating');
            if(!$rating){
                $rating = 0;
            }else{
                $rating = round($rating,2);
            }
        }else{
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
            "academy_name" => $this->academy_name,
            "academy_website" => $this->academy_website,
            "description" => $this->description,
            "description_translations" =>  $this->getTranslations('description'),
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
            "rating" => $rating,
            "booked_appointments" => isset($appointments) && count($appointments) ? count($appointments) : 0,
            "academy_modules" => $pricing_plan ? $pricing_plan->academy_modules()->pluck('pricing_plan_modules.module_code')->toArray():[],
            "academy_settings" => isset($academy_settings) && count($academy_settings) > 0 ? AcademySettingsResource::collection($this->whenLoaded('academy_settings',function(){
                    return $this->academy_settings;
            }))->pluck('value','name')->toArray(): null,
            "academy_category_ids" => isset($academy_categories) && count($academy_categories) > 0 ? AcademyCategoriesResource::collection($this->whenLoaded('academy_categories',function(){
                return $this->academy_categories;
            }))->pluck('id')->toArray():null,
            "academy_teachers" => $academy_teachers ? TeachersResource::collection($academy_teachers) : [],
            "academy_categories" => $academy_categories ? AcademyCategoriesResource::collection($academy_categories):[],
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
        ];
    }
}
