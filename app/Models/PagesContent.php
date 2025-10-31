<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class PagesContent extends Model
{
    use HasFactory , HasTranslations;
    protected $table = "pages_contents";
    public $translatable = ['value'];
    protected $fillable = ['name', 'display_name', 'value', 'is_specific', 'type'];
}
