<?php

namespace App\Http\Resources\API;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class InAppNotificationsResource extends JsonResource
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
        $user = $this->relationLoaded('user') ? $this->whenLoaded('user'):null;


        return [
                "id" =>  $this->id,
                'user_id' => $this->user_id,
                'user_name' => $user ? $user->name :"",
                "name" => $this->name,
                "description" =>  $this->description,
                "redirect_url" =>  $this->redirect_url,
                "is_seen" =>  $this->is_seen,
                "updated_at" =>  $this->updated_at,
        ];
    }
}
