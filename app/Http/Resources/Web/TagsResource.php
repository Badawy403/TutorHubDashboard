<?php

namespace App\Http\Resources\Web;

use Illuminate\Http\Resources\Json\JsonResource;

class TagsResource extends JsonResource
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
        return [
                "id" =>  $this->id,
                "name" =>  $this->name,
                "description" =>  $this->description,
                "slug" =>  $this->slug,
                "is_active" =>  $this->is_active,
                "is_featured" =>  $this->is_featured,
                "icon" =>  $this->icon,
                "image" =>  $this->image,
                "events" =>  EventsResource::collection($this->whenLoaded('events')),
                "archives" =>  ArchivesResource::collection($this->whenLoaded('archives')),
                "posts" =>  PostsResource::collection($this->whenLoaded('posts')),
                "broadcasts" =>  BroadcastsResource::collection($this->whenLoaded('broadcasts')),
                "podcasts" =>  PodcastsResource::collection($this->whenLoaded('podcasts')),
                "created_at" =>  $this->created_at,
                "updated_at" =>  $this->updated_at,
        ];
    }
}
