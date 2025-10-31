<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Certification extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "certifications";
    protected $fillable = ['teacher_id','academy_id', 'name', 'description', 'sort_order', 'image', 'is_active', 'deleted_at'];


    public function scopeWithAll($query)
    {
        return $query->with('academy')->with('teacher');
    }
    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', 1);
    }
    public function scopeHasModulePermissions($query){
        return $query->whereHas('teacher',function($q){
            $q->whereHas('pricing_plan',function($y){{
                $y->whereHas('teacher_modules',function($z){
                    $z->where('pricing_plan_modules.module_code','teacher-certifications');
                });
            }});
        })->orWhereHas('academy',function($q){
            $q->whereHas('pricing_plan',function($y){{
                $y->whereHas('academy_modules',function($z){
                    $z->where('pricing_plan_modules.module_code','academy-certifications');
                });
            }});
        });
    }
    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }
    public function academy()
    {
        return $this->belongsTo(Academy::class);
    }
}
