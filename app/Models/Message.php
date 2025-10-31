<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Message extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "messages";
    protected $fillable = ['message','sender_id','sender_type','reciever_id','reciever_type','appointment_id','booked_service_id','attachment_url','is_attachment', 'is_seen','seen_at','is_delivered','delivered_at', 'deleted_at'];


    public function scopeWithAll($query)
    {
        return ;
    }

}
