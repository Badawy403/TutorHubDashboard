<?php

namespace App\Http\Resources\Web;

use Illuminate\Http\Resources\Json\JsonResource;

class MessagesResource extends JsonResource
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
        $sender_type = "";
        if($this->sender_type == 'App\Models\Teacher'){
            $sender_type = 'teacher';
        }
        if($this->sender_type == 'App\Models\Student'){
            $sender_type = 'student';
        }
        if($this->sender_type == 'App\Models\Academy'){
            $sender_type = 'academy';
        }
        $reciever_type = "";
        if($this->reciever_type == 'App\Models\Teacher'){
            $reciever_type = 'teacher';
        }
        if($this->reciever_type == 'App\Models\Student'){
            $reciever_type = 'student';
        }
        if($this->reciever_type == 'App\Models\Academy'){
            $reciever_type = 'academy';
        }
        return [
                "id" =>  $this->id,
                "message" =>  $this->message,
                "appointment_id" =>  $this->appointment_id,
                "booked_service_id" =>  $this->booked_service_id,
                "sender_id" =>  $this->sender_id,
                "sender_type" =>  $sender_type,
                "reciever_id" =>  $this->reciever_id,
                "reciever_type" =>  $reciever_type,
                "attachment_url" =>  $this->attachment_url,
                "is_attachment" =>  $this->is_attachment ? true : false,
                "is_seen" =>  $this->is_seen ? true : false,
                "seen_at" =>  $this->seen_at,
                "is_delivered" =>  $this->is_delivered ? true : false,
                "delivered_at" =>  $this->delivered_at,
                "created_at" =>  $this->created_at,
                "updated_at" =>  $this->updated_at,
        ];
    }
}
