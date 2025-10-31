<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commission extends Model
{
    use HasFactory;
    protected $fillable = ['appointment_type_id','rate','commission_type'];
    protected $casts = [
        'rate' => 'float',
    ];
    public function scopeWithAll($query)
    {
     return $query->with('category');
   }
    public function appointment_type()
    {
      return $this->belongsTo(AppointmentType::class,'appointment_type_id');
    }

}
