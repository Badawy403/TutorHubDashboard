<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InAppNotification extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = "in_app_notifications";
    protected $fillable = [
        'user_id', 'name', 'description', 'redirect_url', 'is_seen', 'deleted_at'
    ];
    public function scopeWithAll($query){
        return $query->with('user');
    }
    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
