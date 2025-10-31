<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ServiceStatus extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "service_statuses";
    protected $fillable = [
        'display_name', 'description', 'status_code', 'is_active','deleted_at'
    ];

    public static $Pending = 1;
    public static $Accepted = 2;
    public static $Rejected = 3;
    public static $Cancel = 4;
    public static $Completed = 5;
    public function scopeWithAll($query)
    {
        return ;
    }
    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }
    public function booked_services()
    {
        return $this->hasMany(BookedService::class,'service_status_code','status_code');
    }
}
