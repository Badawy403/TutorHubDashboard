<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Post extends Model
{
    use HasFactory, SoftDeletes ,HasTranslations;
    protected $table = "posts";
    public $translatable = ['name','description'];
    protected $fillable = ['teacher_id','academy_id', 'blog_category_id', 'is_featured', 'name', 'description', 'slug', 'sort_order', 'image', 'is_active', 'deleted_at'];


    public function scopeWithAll($query)
    {
        return $query->with('teacher')->with('tags')->with('academy')->with('blog_category');
    }
    public function scopeHasModulePermissions($query){
        return $query->whereHas('teacher',function($q){
            $q->whereHas('pricing_plan',function($y){{
                $y->whereHas('teacher_modules',function($z){
                    $z->where('pricing_plan_modules.module_code','teacher-podcasts');
                });
            }});
        })->orWhereHas('academy',function($q){
            $q->whereHas('pricing_plan',function($y){{
                $y->whereHas('academy_modules',function($z){
                    $z->where('pricing_plan_modules.module_code','academy-podcasts');
                });
            }});
        })->doesntHave('teacher', 'or')->doesntHave('academy' , 'or');
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
    public function academy()
    {
        return $this->belongsTo(Academy::class);
    }
    public function blog_category()
    {
        return $this->belongsTo(BlogCategory::class,'blog_category_id');
    }
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'post_tag');
    }
}
