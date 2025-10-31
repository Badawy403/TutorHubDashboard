<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    use HasFactory;
    protected $fillable = ['name','code','symbol','direction','decimal_places','value','is_default','is_active'];
    public function scopeWithAll($query)
    {
        return $query;
    }
}
