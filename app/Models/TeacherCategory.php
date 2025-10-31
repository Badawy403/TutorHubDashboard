<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class TeacherCategory extends Model
{
    use HasFactory, SoftDeletes , HasTranslations;
    protected $table = "teacher_categories";
    public $translatable = ['name','description'];
    protected $fillable = ['name', 'description', 'slug','parent_category_id', 'sort_order', 'image', 'is_active', 'deleted_at'];


    public function scopeWithAll($query)
    {
        return $query->withCount('teachers')->with('teachers',function($q){
            $q->withCount('teacher_archives');
        });
    }
    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }
    public function teachers()
    {
        return $this->belongsToMany(Teacher::class, 'teacher_category');
    }


    public function main_category()
    {
        return $this->belongsTo(TeacherMainCategory::class, 'parent_category_id');
    }
}
