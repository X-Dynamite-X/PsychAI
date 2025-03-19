<?php

namespace Database\Seeders;

use App\Models\Booking;
use App\Models\SessionDoc;
use App\Models\User;
use Illuminate\Database\Seeder;

class BookingSeeder extends Seeder
{
    public function run(): void
    {
        $sessions = SessionDoc::where('status', 'pending')->get();
        $users = User::whereHas('roles', fn($q) => $q->where('name', 'user'))->get();

        foreach ($sessions as $session) {
            // إنشاء حجز لبعض الجلسات
            if (rand(0, 1)) {
                Booking::create([
                    'specialist_id' => $session->specialist_id,
                    'user_id' => $users->random()->id,
                    'session_doc_id' => $session->id,
                    'amount' => rand(100, 500),
                    'payment_status' => ['pending', 'paid', 'refunded'][rand(0, 2)],
                    'payment_id' => 'PAY_' . uniqid(),
                ]);
            }
        }
    }
}