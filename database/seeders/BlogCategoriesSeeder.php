<?php

namespace Database\Seeders;

use App\Models\BlogCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BlogCategoriesSeeder extends Seeder
{
    public function run(): void
    {
        $cats = [
            ['ar' => 'إدارة المزارع',    'en' => 'Farm Management'],
            ['ar' => 'التغذية والإنتاج', 'en' => 'Feeding & Production'],
            ['ar' => 'تقنيات حديثة',     'en' => 'New Technologies'],
            ['ar' => 'أخبار الصناعة',    'en' => 'Industry News'],
        ];

        foreach ($cats as $i => $c) {
            BlogCategory::updateOrCreate(
                ['slug' => Str::slug($c['en'])],
                ['name' => $c, 'position' => $i + 1]
            );
        }
    }
}
