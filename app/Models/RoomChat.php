<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomChat extends Model
{
    use HasFactory;

    protected $table = 'room_chats'; // تحديد اسم الجدول

    protected $fillable = [
        'user_id', // مفتاح خارجي للمستخدم
        'message',
        'response',
    ];

    // علاقة مع المستخدم
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
