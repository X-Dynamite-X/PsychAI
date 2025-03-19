<?php

namespace Database\Seeders;

use App\Models\Specialty;
use Illuminate\Database\Seeder;

class SpecialtySeeder extends Seeder
{
    public function run(): void
    {
        $specialties = [
            [
                'name' => 'Cognitive Behavioral Therapy',
                'description' => 'Specialized in helping patients identify and change negative thought patterns'
            ],
            [
                'name' => 'Family Therapy',
                'description' => 'Expert in resolving family conflicts and improving communication'
            ],
            [
                'name' => 'Trauma Therapy',
                'description' => 'Specialized in treating PTSD and trauma-related disorders'
            ],
            [
                'name' => 'Anxiety Treatment',
                'description' => 'Focus on treating various anxiety disorders and panic attacks'
            ],
            [
                'name' => 'Depression Treatment',
                'description' => 'Specialized in treating major depressive disorder and related conditions'
            ],
            [
                'name' => 'Addiction Counseling',
                'description' => 'Expert in substance abuse and behavioral addiction treatment'
            ],
            [
                'name' => 'Child Psychology',
                'description' => 'Specialized in treating children and adolescents'
            ],
            [
                'name' => 'Relationship Counseling',
                'description' => 'Focus on improving interpersonal relationships and couples therapy'
            ]
        ];

        foreach ($specialties as $specialty) {
            Specialty::create($specialty);
        }
    }
}
