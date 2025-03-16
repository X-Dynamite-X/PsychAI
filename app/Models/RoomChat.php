<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomChat extends Model
{
    use HasFactory;

    protected $table = 'room_chats'; // تحديد اسم الجدول



    // علاقة مع المستخدم
    protected $fillable = [
        'room_name', // الحقول التي يمكن تعبئتها
            'user_id',
    ];

    // علاقة واحدة إلى كثير مع الرسائل
    public function messages()
    {
        return $this->hasMany(Message::class, 'room_chats_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}