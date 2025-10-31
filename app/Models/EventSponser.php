<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EventSponser extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "event_sponsers";
    protected $fillable = ['event_id','name', 'image', 'deleted_at'];


    public function scopeWithAll($query)
    {
        return $query;
    }


    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
