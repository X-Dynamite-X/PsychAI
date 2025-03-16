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




        $user = User::create([
            'name' => 'dynamite',
            'email' => 'dynamite@gmail.com',
            'password' => Hash::make('123'),
        ]);
        $user = User::create([
            'name' => 'dynamite2',
            'email' => 'abdmoklss@gmail.com',
            'password' => Hash::make('123'),
        ]);


        $user = User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('123'),
        ]);
        $this->call([


            RoomsTableSeeder::class,
        ]);


     }
}