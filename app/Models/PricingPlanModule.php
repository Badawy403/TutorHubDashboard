<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PricingPlanModule extends Model
{
    use HasFactory;
    protected $table = 'pricing_plan_modules';

    protected $fillable = [
        'display_name', 'module_code', 'sort_order', 'type'
    ];

    public function scopeAcademy($query){
        return $query->where('type', 'academy');
    }
    public function scopeTeacher($query){
        return $query->where('type', 'teacher');
    }
}
