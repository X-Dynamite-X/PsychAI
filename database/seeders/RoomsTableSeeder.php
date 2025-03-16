<?php

namespace Database\Seeders;

use App\Models\Message;
use App\Models\RoomChat;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoomsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $room = RoomChat::create([
            'room_name' => 'General Chat',
            'user_id' => 1,
        ]);


        // إضافة رسائل إلى الغرفة
        Message::create([
            'room_chats_id' => $room->id,
            'sender_id' => 1,
            'message_text' => 'Hello, welcome to the General Chat room! user Text',
            'reseve_text' => 'Hello, welcome to the General Chat room! AI Text',
        ]);

        Message::create([
            'room_chats_id' => $room->id,
            'sender_id' => 1,
            'message_text' => 'Hi ! User Text',
            'reseve_text' => 'Hi everyone! Ai Text',
        ]);
        $room = RoomChat::create([
            'room_name' => 'General Chat 2',
            'user_id' => 1,
        ]);
        Message::create([
            'room_chats_id' => $room->id,
            'sender_id' => 1,
            'message_text' => 'Hello, welcome to the General Chat room! User Text',
            'reseve_text' => 'Hello, welcome to the General Chat room! AI Text',
        ]);


    }
}
