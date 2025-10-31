<?php

namespace App\Http\Resources\Web;

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
        $academy_settings = $this->relationLoaded('academy_settings') ? $this->whenLoaded('academy_settings') : null;
        $academy_categories = $this->relationLoaded('academy_categories') ? $this->whenLoaded('academy_categories') : null;
        $languages = $this->relationLoaded('languages') ? $this->whenLoaded('languages') : null;
        $tags = $this->relationLoaded('tags') ? $this->whenLoaded('tags') : null;
        $academy_teachers = $this->relationLoaded('academy_teachers') ? $this->whenLoaded('academy_teachers') : null;
        $academy_certifications = $this->relationLoaded('academy_certifications') ? $this->whenLoaded('academy_certifications') : null;
        $academy_broadcasts = $this->relationLoaded('academy_broadcasts') ? $this->whenLoaded('academy_broadcasts') : null;
        $academy_podcasts = $this->relationLoaded('academy_podcasts') ? $this->whenLoaded('academy_podcasts') : null;
        $academy_events = $this->relationLoaded('academy_events') ? $this->whenLoaded('academy_events') : null;
        $appointment_schedules = $this->relationLoaded('appointment_schedules') ? $this->whenLoaded('appointment_schedules') : null;
        $academy_posts = $this->relationLoaded('academy_posts') ? $this->whenLoaded('academy_posts') : null;
        $academy_archives = $this->relationLoaded('academy_archives') ? $this->whenLoaded('academy_archives') : null;
        $academy_reviews = $this->relationLoaded('academy_reviews') ? $this->whenLoaded('academy_reviews') : null;
        $pricing_plan = $this->relationLoaded('pricing_plan') ? $this->whenLoaded('pricing_plan') : null;
        $country = $this->relationLoaded('country') ? $this->whenLoaded('country') : null;
        $state = $this->relationLoaded('state') ? $this->whenLoaded('state') : null;
        $city = $this->relationLoaded('city') ? $this->whenLoaded('city') : null;
        $appointments = $this->relationLoaded('appointments') ? $this->whenLoaded('appointments'):null;
        if ($academy_reviews) {
            $rating = $academy_reviews->avg('rating');
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
            "country_name" => $country ? $country->name : "",
            "state_id" => $this->state_id,
            "state_name" => $state ? $state->name : "",
            "city_id" => $this->city_id,
            "city_name" => $city ? $city->name : "",
            "distance" => $this->distance,

            "name" => $this->name,
            "first_name" => $this->first_name,
            "last_name" => $this->last_name,
            "academy_name" => $this->academy_name,
            "academy_website" => $this->academy_website,
            "description" => $this->description,
            "description_translations" =>  $this->getTranslations('description'),
            "address_line_1" => $this->address_line_1,
            "address_line_2" => $this->address_line_2,
            "longitude" => $this->longitude,
            "latitude" => $this->latitude,
            "user_name" => $this->user_name,
            "zip_code" => $this->zip_code,
            "is_approved" => $this->is_approved,
            "approved_at" => $this->approved_at,
            "is_active" => $this->is_active,
            "is_featured" => $this->is_featured,

            'prefix' => $this->prefix,
            'suffix' => $this->suffix,
            'home_phone' => $this->home_phone,
            'cell_phone' => $this->cell_phone,
            'job_title' => $this->job_title,
            'company' => $this->company,
            'website' => $this->website,
            'email' => $this->email,

            'billing_address_line_1' => $this->billing_address_line_1,
            'billing_address_line_2' => $this->billing_address_line_2,
            'billing_country_id' => $this->billing_country_id,
            'billing_state_id' => $this->billing_state_id,
            'billing_city_id' => $this->billing_city_id,
            'billing_zip_code' => $this->billing_zip_code,

            'shipping_address_line_1' => $this->shipping_address_line_1,
            'shipping_address_line_2' => $this->shipping_address_line_2,
            'shipping_country_id' => $this->shipping_country_id,
            'shipping_state_id' => $this->shipping_state_id,
            'shipping_city_id' => $this->shipping_city_id,
            'shipping_zip_code' => $this->shipping_zip_code,

            'work_address_line_1' => $this->work_address_line_1,
            'work_address_line_2' => $this->work_address_line_2,
            'work_country_id' => $this->work_country_id,
            'work_state_id' => $this->work_state_id,
            'work_city_id' => $this->work_city_id,
            'work_zip_code' => $this->work_zip_code,


            "icon" => $this->icon,
            "image" => $this->image,
            "cover_image" => $this->cover_image,
            "rating" => $rating,
            "booked_appointments" => count($appointments),
            "pricing_plan_name" => $pricing_plan->name ?? "",
            "academy_modules" => $pricing_plan ? $pricing_plan->academy_modules()->pluck('pricing_plan_modules.module_code')->toArray() : [],
            "academy_settings" => $academy_settings ? AcademySettingsResource::collection($this->whenLoaded('academy_settings', function () {
                return $this->academy_settings;
            }))->pluck('value', 'name')->toArray() : [],
            "academy_category_ids" => $academy_categories ? AcademyCategoriesResource::collection($this->whenLoaded('academy_categories', function () {
                return $this->academy_categories;
            }))->pluck('id')->toArray() : [],
            "academy_categories" => $academy_categories ? AcademyCategoriesResource::collection($academy_categories) : [],
            "language_ids" => $languages ? AllLanguagesResource::collection($this->whenLoaded('languages', function () {
                return $this->languages;
            }))->pluck('id')->toArray() : [],
            "languages" => $languages ? AllLanguagesResource::collection($languages) : [],
            "tag_ids" => $tags ? TagsResource::collection($this->whenLoaded('tags', function () {
                return $this->tags;
            }))->pluck('id')->toArray() : [],
            "tags" => $tags ? TagsResource::collection($tags) : [],
            "academy_teachers" => $academy_teachers ? TeachersResource::collection($academy_teachers) : [],
            "academy_broadcasts" => $academy_broadcasts ? BroadcastsResource::collection($academy_broadcasts) : [],
            "academy_podcasts" => $academy_podcasts ? BroadcastsResource::collection($academy_podcasts) : [],
            "academy_events" => $academy_events ? EventsResource::collection($academy_events) : [],
            "academy_posts" => $academy_posts ? PostsResource::collection($academy_posts) : [],
            "academy_archives" => $academy_archives ? PostsResource::collection($academy_archives) : [],
            "academy_reviews" => $academy_reviews ? AcademyReviewsResource::collection($academy_reviews) : [],
            "academy_certifications" => $academy_certifications ? CertificationsResource::collection($academy_certifications) : [],
            "appointment_types" => $appointment_schedules ? AppointmentSchedulesResource::collection($appointment_schedules)->keyBy('appointment_type.type') : [],
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
        ];
    }
}
