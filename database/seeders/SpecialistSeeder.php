<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class SpecialistSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::with("roles")->whereHas("roles", function ($query) {
            $query->where("name", "doctor");
        })->get();

        $descriptions = [
            'متخصص في العلاج النفسي والإرشاد الأسري',
            'خبير في علاج القلق والاكتئاب',
            'متخصص في العلاج السلوكي المعرفي',
            'معالج نفسي متخصص في الصدمات النفسية',
        ];

        $locations = ['الأردن', 'مصر', 'السعودية', 'الإمارات'];
        $costs = ['200$', '300$', '400$', '500$'];

        $users->each(function ($user) use ($descriptions, $locations, $costs) {
            $user->specialist()->create([
                'category_id' => rand(1, 4),
                'description' => $descriptions[array_rand($descriptions)],
                'Cost' => $costs[array_rand($costs)],
                'live' => $locations[array_rand($locations)],
                'phone' => '+962' . rand(700000000, 799999999),
            ]);
        });
    }
}

