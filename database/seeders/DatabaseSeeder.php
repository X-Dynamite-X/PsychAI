<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call([
            RoleSeeder::class,
            CategoriesSeeder::class,
        ]);

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

        for ($i = 0; $i < 100; $i++) {
            $user = User::create([
                'name' => "user_".($i+1),
                'email' => "user_".($i+1)."@gmial.com",
                'password' => Hash::make(value: '123'),
            ]);
            if($i%10 ===0){

                $user->syncRoles("doctor");
            }else{
                $user->syncRoles("user");

            }
        }
    }
}