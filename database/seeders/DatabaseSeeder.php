<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            CategoriesSeeder::class,
        ]);

        // إنشاء المستخدمين الأساسيين
        $user = User::create([
            'name' => 'dynamite',
            'email' => 'dynamite@gmail.com',
            'password' => Hash::make('123'),
        ]);
        $user->assignRole(['admin', 'doctor']);

        $user = User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('123'),
        ]);
        $user->assignRole('admin');

        $user = User::create([
            'name' => 'doctor',
            'email' => 'doctor@gmail.com',
            'password' => Hash::make('123'),
        ]);
        $user->assignRole('doctor');

        // إنشاء مستخدمين إضافيين
        for ($i = 0; $i < 100; $i++) {
            $user = User::create([
                'name' => "user_".($i+1),
                'email' => "user_".($i+1)."@gmail.com",
                'password' => Hash::make('123'),
            ]);
            if($i % 10 === 0){
                $user->syncRoles("doctor");
            } else {
                $user->syncRoles("user");
            }
        }

        // تشغيل باقي السيدرز
        $this->call([
            SpecialistSeeder::class,
            SessionDocSeeder::class,
            BookingSeeder::class,
        ]);
    }
}
