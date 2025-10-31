<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Broadcast extends Model
{
    use HasFactory, SoftDeletes , HasTranslations;
    protected $table = "broadcasts";
    public $translatable = ['name','description'];
    protected $fillable = ['teacher_id','academy_id', 'broadcast_category_id', 'is_featured', 'name', 'description', 'slug', 'sort_order', 'image','file_type','link_type','file_url','audio','video', 'is_active', 'deleted_at'];


    public function scopeWithAll($query)
    {
        return $query->with('tags')->with('teacher')->with('academy')->with('broadcast_category');
    }
    public function scopeHasModulePermissions($query){
        return $query->whereHas('teacher',function($q){
            $q->whereHas('pricing_plan',function($y){{
                $y->whereHas('teacher_modules',function($z){
                    $z->where('pricing_plan_modules.module_code','teacher-broadcast');
                });
            }});
        })->orWhereHas('academy',function($q){
            $q->whereHas('pricing_plan',function($y){{
                $y->whereHas('academy_modules',function($z){
                    $z->where('pricing_plan_modules.module_code','academy-broadcast');
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
    public function broadcast_category()
    {
        return $this->belongsTo(BroadcastCategory::class);
    }
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'broadcast_tag');
    }
}
