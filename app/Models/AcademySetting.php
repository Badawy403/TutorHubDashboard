<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcademySetting extends Model
{
    use HasFactory;
    protected $table = "academy_settings";
    protected $fillable = ['academy_id','name', 'display_name', 'value', 'is_specific', 'type'];
}
