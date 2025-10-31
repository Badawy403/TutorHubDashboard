<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Tag extends Model
{
    use HasFactory, SoftDeletes , HasTranslations;
    protected $table = "tags";
    public $translatable = ['name','description'];
    protected $fillable = ['name', 'description', 'slug', 'sort_order', 'image', 'is_featured','is_active', 'deleted_at'];


    public function scopeWithAll($query)
    {
        return $query;
    }
    public function scopeWithChildrens($query)
    {
        return $query->with('events',function($q){
            $q->hasModulePermissions();
        })->with('archives',function($q){
            $q->hasModulePermissions();
        })->with('broadcasts',function($q){
            $q->hasModulePermissions();
        })->with('posts',function($q){
            $q->hasModulePermissions();
        })->with('podcasts',function($q){
            $q->hasModulePermissions();
        });
    }
    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }
    public function scopeFeatured($query)
    {
        return $query->where('is_active', 1);
    }

    public function archives()
    {
        return $this->belongsToMany(Archive::class, 'archive_tag');
    }
    public function broadcasts()
    {
        return $this->belongsToMany(Broadcast::class, 'broadcast_tag');
    }
    public function posts()
    {
        return $this->belongsToMany(Post::class, 'post_tag');
    }
    public function podcasts()
    {
        return $this->belongsToMany(Podcast::class, 'podcast_tag');
    }
    public function events()
    {
        return $this->belongsToMany(Event::class, 'event_tag');
    }
}
