<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    protected $fillable = [
        'user_id', 'country_id', 'state_id', 'city_id', 'state_id', 'first_name','last_name','user_name','zip_code',
        'description', 'address_line_1','address_line_2', 'is_active', 'is_approved', 'approved_at', 'is_featured', 'icon',
        'image', 'cover_image','is_online'
    ];

    protected $casts = [
        'approved_at' => 'datetime',
    ];
    public function getNameAttribute(){
        return $this->first_name.' '.$this->last_name;
    }
    public function scopeWithAll($query)
    {
        return $query;
    }
    public function scopeWithChildrens($query)
    {
        return $query;
    }
    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', 1);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function teacher_reviews()
    {
        return $this->hasMany(TeacherReview::class);
    }
    public function academy_reviews()
    {
        return $this->hasMany(AcademyReview::class);
    }
    public function appointments()
    {
        return $this->hasMany(BookAppointment::class);
    }
    public function services()
    {
        return $this->hasMany(BookedService::class);
    }
}

