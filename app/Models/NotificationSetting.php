<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NotificationSetting extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "notification_settings";
    protected $fillable = ['user_id','display_name','notification_type','is_email_send','is_push_notification_send','is_in_app_notification_send','notification_category','is_active', 'deleted_at'];


    public function scopeWithAll($query){
        return $query;
    }
    public function scopeActive($query){
        return $query->where('is_active', 1);
    }
}
