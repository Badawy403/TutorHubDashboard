<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Country extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "countries";
    protected $fillable = ['name', 'description','longitude','latitude','iso_code_2',
                            'iso_code_3','phone_code','capital','currency','currency_symbol',
                            'native','region','sub_region','emoji', 'iso_code',
                             'sort_order', 'image', 'is_active', 'deleted_at'];


    public function scopeWithAll($query)
    {
        return $query;
    }
    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }
    public function states()
    {
        return $this->hasMany(State::class, 'country_id');
    }
}
