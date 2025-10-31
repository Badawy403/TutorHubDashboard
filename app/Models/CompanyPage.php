<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class CompanyPage extends Model
{
    use HasFactory, SoftDeletes, HasTranslations;

    protected $table = "company_pages";
    public $translatable = ['name','heading','description'];
    protected $fillable = ['name','heading', 'description', 'slug', 'sort_order', 'image', 'is_active', 'is_default', 'deleted_at'];


    public function scopeWithAll($query)
    {
        return $query;
    }
    public function scopeNotDefault($query)
    {
        return $query->where('is_default', 0)->orWhereNull('is_default');
    }
    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }
    public function academies()
    {
        return $this->belongsToMany(Academy::class, 'academy_category');
    }
}
