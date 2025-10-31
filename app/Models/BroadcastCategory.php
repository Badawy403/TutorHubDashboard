<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class BroadcastCategory extends Model
{
    use HasFactory, SoftDeletes , HasTranslations;
    protected $table = "broadcast_categories";
    public $translatable = ['name','description'];
    protected $fillable = ['name', 'description', 'slug', 'sort_order', 'image', 'is_active', 'deleted_at'];


    public function scopeWithAll($query)
    {
        return $query;
    }
    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }
    public function teacher_broadcasts()
    {
        return $this->hasMany(Broadcast::class, 'broadcast_category_id');
    }
}
