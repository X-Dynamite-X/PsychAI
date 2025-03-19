<?php

namespace Database\Seeders;

use App\Models\SessionDoc;
use App\Models\Specialist;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class SessionDocSeeder extends Seeder
{
    public function run(): void
    {
        $specialists = Specialist::all();
        
        foreach ($specialists as $specialist) {
            // إنشاء 5 جلسات لكل مختص
            for ($i = 0; $i < 5; $i++) {
                SessionDoc::create([
                    'specialist_id' => $specialist->id,
                    'user_id' => $specialist->user_id,
                    'date' => Carbon::now()->addDays(rand(1, 30))->format('Y-m-d'),
                    'time' => sprintf('%02d:00:00', rand(9, 17)), // من 9 صباح<|im_start|> إلى 5 مساء
                    'status' => ['pending', 'confirmed', 'completed', 'cancelled'][rand(0, 3)],
                    'type' => ['online', 'in-person'][rand(0, 1)],
                    'notes' => 'ملاحظات تجريبية للجلسة ' . ($i + 1),
                ]);
            }
        }
    }
}