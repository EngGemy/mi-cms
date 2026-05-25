<?php

namespace Database\Seeders;

use App\Models\HeroSlide;
use Illuminate\Database\Seeder;

class HeroSlidesSeeder extends Seeder
{
    public function run(): void
    {
        $slides = [
            ['label' => ['ar' => 'للمزارع التجارية', 'en' => 'For Commercial Farms'], 'image_url' => 'https://images.unsplash.com/photo-1569466593977-94ee7ed02ec9?w=1400&q=85&auto=format&fit=crop'],
            ['label' => ['ar' => 'لإنتاج البيض', 'en' => 'For Egg Production'], 'image_url' => 'https://images.unsplash.com/photo-1648141499246-97a0eb56c2fd?w=1400&q=85&auto=format&fit=crop'],
            ['label' => ['ar' => 'للتسمين الصناعي', 'en' => 'For Industrial Broilers'], 'image_url' => 'https://images.unsplash.com/photo-1553531009-c4605f302b47?w=1400&q=85&auto=format&fit=crop'],
            ['label' => ['ar' => 'للمستثمرين الجدد', 'en' => 'For New Investors'], 'image_url' => 'https://plus.unsplash.com/premium_photo-1682126534413-5c7ac3ac54c4?w=1400&q=85&auto=format&fit=crop'],
        ];

        foreach ($slides as $i => $s) {
            HeroSlide::updateOrCreate(
                ['position' => $i + 1],
                ['label' => $s['label'], 'image_url' => $s['image_url'], 'is_active' => true]
            );
        }
    }
}
