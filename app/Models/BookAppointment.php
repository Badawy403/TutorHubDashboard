<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BookAppointment extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "booked_appointments";
    protected $fillable = [
        'student_id', 'teacher_id', 'academy_id','date', 'start_time', 'fee', 'is_paid', 'appointment_type_id', 'end_time', 'question','started_at','ended_at',
        'attachment_url','appointment_status_code','fund_id','deleted_at'
    ];

    public function scopeWithAll($query)
    {
        return $query->with('fund')->with('student')->with('ratings')->with('appointment_type')->with('appointment_status')->with('teacher')->with('academy')->with('messages');
    }
    public  function fund()
    {
        return $this->belongsTo(Fund::class);
    }
    public  function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }
    public  function academy()
    {
        return $this->belongsTo(Academy::class);
    }
    public  function appointment_type()
    {
        return $this->belongsTo(AppointmentType::class);
    }
    public function student(){
        return $this->belongsTo(Student::class);
     }
     public function appointment_status(){
        return $this->belongsTo(AppointmentStatus::class,'appointment_status_code','status_code');
     }
     public function messages()
    {
        return $this->hasMany(Message::class,'appointment_id');
    }

    public function ratings()
    {
        return $this->hasMany(AppointmentRating::class, 'booked_appointment_id');

    }
    public function getIsStartedAttribute() {
        return $this->attributes['started_at'] ? true : false;
    }
    public function getIsEndedAttribute() {
        return $this->attributes['ended_at'] ? true : false;
    }
}
