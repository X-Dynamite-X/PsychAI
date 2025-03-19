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
                'name' => 'القلق',
                'description' => 'حالة صحية نفسية تتميز بالقلق المفرط والخوف والتوتر.',
            ],
            [
                'name' => 'الاكتئاب',
                'description' => 'اضطراب مزاجي يتميز بمشاعر مستمرة من الحزن وفقدان الاهتمام بالأنشطة.',
            ],
            [
                'name' => 'الإرهاق',
                'description' => 'حالة من الإرهاق العاطفي والجسدي والعقلي الناتج عن الضغط المستمر.',
            ],
            [
                'name' => 'متلازمة المحتال',
                'description' => 'نمط نفسي يشكك فيه الأفراد في قدراتهم ويخشون من اكتشافهم كمحتالين رغم كفاءتهم.',
            ],
        ];
        foreach ($categories as $category) {
            \App\Models\Category::create($category);
        }
    }
}
