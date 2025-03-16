<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    //
    protected $fillable = [
        'room_chats_id',
        'sender_id',
        'message_text',
        'reseve_text',
    ];

    // علاقة كثير إلى واحدة مع الغرفة
    // علاقة كثير إلى واحدة مع الغرفة
    public function room()
    {
        return $this->belongsTo(RoomChat::class);
    }

    // علاقة كثير إلى واحدة مع المستخدم
    public function user()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }
}