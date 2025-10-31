<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class AcademyMainCategory extends Model
{
    use HasFactory, SoftDeletes , HasTranslations;
    protected $table = "academy_main_categories";
    public $translatable = ['name','description'];
    protected $fillable = ['name', 'description', 'slug', 'sort_order', 'image', 'is_active','is_featured', 'deleted_at'];


    public function scopeWithAll($query)
    {
        return $query;
    }
    public function scopeWithChildrens($query)
    {
        return $query->with('categories',function($q){
            $q->active();
        });
    }
    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', 1);
    }
    public function categories()
    {
        return $this->hasMany(AcademyCategory::class,'parent_category_id');
    }
}
