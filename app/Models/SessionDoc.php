<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SessionDoc extends Model
{
    protected $table = 'sessions_doc';

    protected $fillable = [
        'specialist_id',
        'user_id',
        'date',
        'time',
        'status',
        'type',
        'notes'
    ];

    public function specialist()
    {
        return $this->belongsTo(Specialist::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function booking()
    {
        return $this->hasOne(Booking::class);
    }
}
