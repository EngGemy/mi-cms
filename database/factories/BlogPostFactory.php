<?php

namespace Database\Factories;

use App\Models\BlogCategory;
use App\Models\BlogPost;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class BlogPostFactory extends Factory
{
    protected $model = BlogPost::class;

    public function definition(): array
    {
        $titleAr = fake('ar_SA')->sentence();
        $titleEn = fake()->sentence();

        return [
            'title' => ['ar' => $titleAr, 'en' => $titleEn],
            'excerpt' => ['ar' => fake('ar_SA')->paragraph(), 'en' => fake()->paragraph()],
            'content' => ['ar' => fake('ar_SA')->paragraphs(5, true), 'en' => fake()->paragraphs(5, true)],
            'slug' => Str::slug($titleEn),
            'status' => 'published',
            'published_at' => fake()->dateTimeBetween('-1 year'),
            'author_id' => User::factory(),
            'blog_category_id' => BlogCategory::factory(),
        ];
    }

    public function draft(): static
    {
        return $this->state(fn () => ['status' => 'draft', 'published_at' => null]);
    }
}
