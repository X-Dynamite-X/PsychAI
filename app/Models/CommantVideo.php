<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommantVideo extends Model
{
    //
    protected $fillable = [
        'video_id',
        'user_id',
        'comment',
    ];
        public function video()
    {
        return $this->belongsTo(Video::class);
    }
        public function user()
    {
        return $this->belongsTo(User::class);
    }
}
