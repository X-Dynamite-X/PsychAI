<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        ]);


        $user = User::create([
            'name' => 'dynamite',
            'email' => 'dynamite@gmail.com',
            'password' => Hash::make('123'),
        ]);
        if ($user) {
            $user->assignRole(['admin', 'user', 'doctor']);
        }

        $user = User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('123'),
        ]);

        if ($user) {
            $user->assignRole(['admin', 'user', 'doctor']);
        }
     }
}
