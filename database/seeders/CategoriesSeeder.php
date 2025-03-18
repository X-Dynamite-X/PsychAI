<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $categories = [
            [
                'name' => 'Anxiety',
                'description' => 'A mental health condition characterized by excessive worry, fear, or tension.',
            ],
            [
                    'name' => 'Depression',
                    'description' => 'A mood disorder marked by persistent feelings of sadness and loss of interest.',
            ],
            [
                'name' => 'Burnout',
                'description' => 'A state of emotional, physical, and mental exhaustion caused by prolonged stress.',
            ],
            [
                'name' => 'Impostor Syndrome',
                'description' => 'A psychological pattern where individuals doubt their abilities and fear being exposed as frauds.',
            ],
        ];
        foreach ($categories as $category) {
            \App\Models\Category::create($category);
        }
    }
}
