<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TeacherReview extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "teacher_reviews";
    protected $fillable = ['teacher_id', 'student_id', 'rating','experience','communication','service', 'comment', 'is_active', 'deleted_at'];


    public function scopeWithAll($query)
    {
        return $query->with('student');
    }
    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', 1);
    }
    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }
    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
