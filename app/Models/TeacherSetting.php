<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherSetting extends Model
{
    use HasFactory;
    protected $table = "teacher_settings";
    protected $fillable = ['teacher_id','name', 'display_name', 'value', 'is_specific', 'type'];
}
