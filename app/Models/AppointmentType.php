<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AppointmentType extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "appointment_types";
    protected $fillable = ['display_name','description', 'type', 'is_schedule_required', 'is_paid', 'is_active', 'deleted_at'];


    public function scopeWithAll($query)
    {
        return ;
    }
    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }
    public function scopePaid($query)
    {
        return $query->where('is_paid', 1);
    }
    public function schedule(){
        return $this->belongsTo(AppointmentSchedule::class,'appointment_type_id','id');
    }
    public function appointments()
    {
        return $this->hasMany(BookAppointment::class);
    }
    public function commission()
    {
        return $this->hasOne(Commission::class, 'appointment_type_id');
    }
}
