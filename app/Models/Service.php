<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Service extends Model
{
    use HasFactory, SoftDeletes , HasTranslations;
    protected $table = "services";
    public $translatable = ['name','description'];
    protected $fillable = ['teacher_id','academy_id','service_category_id', 'name', 'description', 'slug', 'sort_order', 'image','video','price','is_approved','is_featured','approved_at', 'is_active', 'deleted_at'];


    public function scopeWithAll($query)
    {
        return $query->with('teacher')->with('academy')->with('tags')->with('faqs')->with('service_category');
    }
    public function scopeWithChildrens($query){
        return $query->with('booked_services')->with('reviews',function($q){
            $q->withAll();
        });
    }

    public function scopeHasModulePermissions($query){
        return $query->whereHas('teacher',function($q){
            $q->whereHas('pricing_plan',function($y){{
                $y->whereHas('teacher_modules',function($z){
                    $z->where('pricing_plan_modules.module_code','teacher-services');
                });
            }});
        })->orWhereHas('academy',function($q){
            $q->whereHas('pricing_plan',function($y){{
                $y->whereHas('academy_modules',function($z){
                    $z->where('pricing_plan_modules.module_code','academy-services');
                });
            }});
        })->doesntHave('teacher', 'or')->doesntHave('academy' , 'or');
    }
    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }
    public function scopeApproved($query)
    {
        return $query->where('is_approved', 1);
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
    public function service_category()
    {
        return $this->belongsTo(ServiceCategory::class);
    }
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'service_tag');
    }
    public function faqs()
    {
        return $this->hasMany(ServiceFaq::class, 'service_id');
    }
    public function reviews()
    {
        return $this->hasMany(ServiceReview::class, 'service_id');
    }
    public function booked_services()
    {
        return $this->hasMany(BookedService::class, 'service_id');
    }
}
