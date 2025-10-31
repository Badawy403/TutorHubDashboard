<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class FAQCategory extends Model
{
    use HasFactory, SoftDeletes , HasTranslations;
    protected $table = "faq_categories";
    public $translatable = ['name','description'];
    protected $fillable = ['name', 'description', 'slug', 'sort_order', 'image', 'is_active', 'deleted_at'];


    public function scopeWithAll($query)
    {
        return $query;
    }
    public function scopeWithChildrens($query)
    {
        return $query->with('faqs');
    }
    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }
    public function faqs()
    {
        return $this->hasMany(FAQ::class, 'faq_category_id');
    }
}
