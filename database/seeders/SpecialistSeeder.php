<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Specialty;
use Illuminate\Database\Seeder;

class SpecialistSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::with("roles")->whereHas("roles", function ($query) {
            $query->where("name", "doctor");
        })->get();

        $descriptions = [
            'Expert in psychological therapy and family counseling',
            'Specialized in anxiety and depression treatment',
            'Expert in cognitive behavioral therapy',
            'Specialized in trauma therapy and PTSD treatment',
        ];

        $locations = ['Jordan', 'Egypt', 'Saudi Arabia', 'UAE'];
        $costs = ['200$', '300$', '400$', '500$'];

        // Get all specialties
        $specialties = Specialty::all();

        $users->each(function ($user) use ($descriptions, $locations, $costs, $specialties) {
            // Create specialist profile
            $specialist = $user->specialist()->create([
                'category_id' => rand(1, 4),
                'description' => $descriptions[array_rand($descriptions)],
                'cost' => $costs[array_rand($costs)],
                'location' => $locations[array_rand($locations)],
                'phone' => '+962' . rand(700000000, 799999999),
                'experience' => rand(1, 10),
            ]);

            // Assign 2-4 random specialties to each specialist
            $specialist->specialties()->attach(
                $specialties->random(rand(2, 4))->pluck('id')->toArray()
            );
        });
    }
}
