<?php

namespace Database\Seeders;
use App\Model\Category;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('categories')->insert([
            ['name' => 'قلق'],
            ['name' => 'اكتئاب'],
            ['name' => 'متلازمة المحتال'],
            ['name' => ' الإرهاق'],
        ]);
    }
}