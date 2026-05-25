<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            HeroSlidesSeeder::class,
            ProductsSeeder::class,
            FeaturesSeeder::class,
            ProductionStagesSeeder::class,
            ProjectsSeeder::class,
            TeamMembersSeeder::class,
            TestimonialsSeeder::class,
            FaqsSeeder::class,
            ChairmanQuotesSeeder::class,
            BlogCategoriesSeeder::class,
            BlogPostsSeeder::class,
            CertificationsSeeder::class,
        ]);
    }
}
