<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AppointmentScheduleSlot extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "appointment_schedule_slots";
    protected $fillable = ['schedule_id','is_active','start_time', 'end_time', 'deleted_at'];


    public function scopeWithAll($query)
    {
        return ;
    }
    public function appointment_schedule()
    {
        return $this->belongsTo(AppointmentSchedule::class,'schedule_id');
    }
}
