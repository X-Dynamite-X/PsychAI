<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Specialist extends Model
{
    protected $fillable = [
        'description',
        'cost',
        'location',
        'phone',
        'user_id',
        "category_id",
        "experience",
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // علاقة المراجعات (reviews)
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    // علاقة التخصصات (specialties)
    public function specialties()
    {
        return $this->belongsToMany(Specialty::class, 'specialist_specialties');
    }

    // علاقة الجلسات (sessions)
    public function sessions()
    {
        return $this->hasMany(SessionDoc::class);
    }

    // علاقة الحجوزات (bookings)
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}