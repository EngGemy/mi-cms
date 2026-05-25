<?php

namespace Database\Factories;

use App\Models\BlogCategory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class BlogCategoryFactory extends Factory
{
    protected $model = BlogCategory::class;

    public function definition(): array
    {
        $nameAr = fake('ar_SA')->word();
        $nameEn = fake()->word();
        return [
            'name' => ['ar' => $nameAr, 'en' => $nameEn],
            'slug' => Str::slug($nameEn . '-' . fake()->randomNumber(4)),
            'is_active' => true,
        ];
    }
}
