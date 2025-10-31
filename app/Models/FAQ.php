<?php

namespace App\Models;

use App\Models\FAQCategory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class FAQ extends Model
{
    use HasFactory, SoftDeletes , HasTranslations;
    protected $table = "faqs";
    public $translatable = ['name','description'];
    protected $fillable = ['faq_category_id', 'is_featured', 'name', 'description', 'slug', 'sort_order', 'image', 'is_active', 'deleted_at'];


    public function scopeWithAll($query)
    {
        return $query;
    }
    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }
    public function faq_category()
    {
        return $this->belongsTo(FAQCategory::class, 'faq_category_id');
    }
}
