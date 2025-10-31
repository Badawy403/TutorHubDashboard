<?php

namespace App\Http\Resources\Web;

use Illuminate\Http\Resources\Json\JsonResource;

class PricingPlansResource extends JsonResource
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
        $modules = $this->relationLoaded('modules') ? $this->whenLoaded('modules'):null;
        return [
                "id" =>  $this->id,
                "name" =>  $this->name,
                "description" =>  $this->description,
                "tagline" =>  $this->tagline,
                "color" =>  $this->color,
                "slug" =>  $this->slug,
                "is_active" =>  $this->is_active,
                "is_paid" =>  $this->is_paid,
                "image" =>  $this->image,
                "type" =>  $this->type,
                "price" =>  $this->price,
                "modules" => $modules ? $modules->where('type',$this->type)->pluck('module_code')->toArray(): [],
                "created_at" =>  $this->created_at,
                "updated_at" =>  $this->updated_at,
        ];
    }
}
