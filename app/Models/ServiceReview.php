<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ServiceReview extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "service_reviews";
    protected $fillable = [
        'booked_service_id', 'service_id','student_id','teacher_id','academy_id','rating','experience','communication','service','is_active','is_featured','is_approved','comment','deleted_at'
    ];

    public function scopeWithAll($query)
    {
        return $query->with('student')->with('teacher')->with('academy');
    }
    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }
    public function student()
    {
        return $this->belongsTo(Student::class);
    }
    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }
    public function academy()
    {
        return $this->belongsTo(Academy::class);
    }
    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }


}
