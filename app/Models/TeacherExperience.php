<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TeacherExperience extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "teacher_experiences";
    protected $fillable = ['teacher_id', 'company','description', 'from', 'to', 'image', 'is_active', 'deleted_at'];
    protected $casts = [
        'from' => 'datetime',
        'to' => 'datetime',
    ];

    public function scopeWithAll($query)
    {
        return $query->with('teacher');
    }
    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

}
