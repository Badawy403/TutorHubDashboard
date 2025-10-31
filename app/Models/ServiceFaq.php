<?php

namespace App\Models;

use App\Models\FAQCategory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class ServiceFaq extends Model
{
    use HasFactory, SoftDeletes , HasTranslations;
    protected $table = "service_faqs";
    public $translatable = ['question','answer'];
    protected $fillable = ['service_id', 'is_featured', 'question', 'answer', 'sort_order', 'image', 'is_active', 'deleted_at'];


    public function scopeWithAll($query)
    {
        return $query;
    }
    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }
    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }
}
