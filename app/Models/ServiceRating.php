<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ServiceRating extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "service_ratings";
    protected $fillable = [
        'booked_service_id', 'fromable_id', 'fromable_type', 'to_id','to_type','rating','comment','deleted_at'
    ];

    public function scopeWithAll($query)
    {
        return ;
    }
    public function getFromAbleTypeAttribute() {
        if ($this->attributes['fromable_type'] == 'App\Models\Student') {
            return 'student';
         }
         if ($this->attributes['fromable_type'] == 'App\Models\Teacher') {
            return 'teacher';
         }  if ($this->attributes['fromable_type'] == 'App\Models\Academy') {
            return 'academy';
         }
    }
    public function getToAbleTypeAttribute() {
        if ($this->attributes['to_type'] == 'App\Models\Student') {
            return 'student';
         }
         if ($this->attributes['to_type'] == 'App\Models\Teacher') {
            return 'teacher';
         }  if ($this->attributes['to_type'] == 'App\Models\Academy') {
            return 'academy';
         }
    }
    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }
    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }
    public function student()
    {
        return $this->belongsTo(Student::class);
    }
    public function service()
    {
        return $this->belongsTo(BookedService::class, 'booked_service_id');
    }
    public function from()
    {
        return $this->morphTo('fromable');
    }
    public function to()
    {
        return $this->morphTo('to');
    }


}
