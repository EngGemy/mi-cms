<?php

namespace Database\Seeders;

use App\Models\BlogCategory;
use App\Models\BlogPost;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BlogPostsSeeder extends Seeder
{
    public function run(): void
    {
        $author   = User::first();
        $category = BlogCategory::first();

        $posts = [
            [
                'title'   => ['ar' => 'كيف تختار نظام بطاريات الدواجن المناسب لمشروعك',
                              'en' => 'How to choose the right poultry battery system for your project'],
                'excerpt' => ['ar' => 'دليل شامل للمستثمرين الجدد لاختيار النظام الأنسب من حيث السعة والتكلفة.',
                              'en' => 'A complete guide for new investors choosing the right system by capacity and cost.'],
                'content' => ['ar' => '<p>اختيار نظام بطاريات الدواجن المناسب هو القرار الأهم في رحلة المستثمر الجديد...</p><h2>1. حدّد طاقة الإنتاج المستهدفة</h2><p>قبل أي شيء، احسب عدد الطيور التي تريد تربيتها...</p>',
                              'en' => '<p>Choosing the right poultry battery system is the most important decision...</p><h2>1. Define your target capacity</h2><p>First, calculate the number of birds...</p>'],
            ],
            [
                'title'   => ['ar' => '5 طرق لتقليل تكلفة العلف بنسبة 20% في مزارع التسمين',
                              'en' => '5 ways to cut feed costs by 20% in broiler farms'],
                'excerpt' => ['ar' => 'تقنيات حديثة في توزيع العلف وأنظمة التغذية الذكية تقلّل الهدر وترفع الكفاءة.',
                              'en' => 'Modern feed distribution techniques and smart feeding systems that reduce waste and boost efficiency.'],
                'content' => ['ar' => '<p>تكلفة العلف تشكّل 70% من التكلفة التشغيلية لأي مزرعة دواجن...</p>',
                              'en' => '<p>Feed costs account for 70% of any poultry farm\'s operating costs...</p>'],
            ],
            [
                'title'   => ['ar' => 'أحدث تطورات منصات IoT في إدارة المزارع الذكية',
                              'en' => 'Latest IoT platform developments in smart farm management'],
                'excerpt' => ['ar' => 'كيف غيّرت منصات إنترنت الأشياء طريقة إدارة المزارع الكبرى في 2026.',
                              'en' => 'How IoT platforms have transformed how large farms operate in 2026.'],
                'content' => ['ar' => '<p>منصة MI-OS هي أحدث منصاتنا التي تجمع بين البساطة والقوة...</p>',
                              'en' => '<p>MI-OS is our newest platform that combines simplicity with power...</p>'],
            ],
        ];

        foreach ($posts as $i => $p) {
            BlogPost::updateOrCreate(
                ['slug' => Str::slug($p['title']['en'])],
                array_merge($p, [
                    'author_id'       => $author?->id ?? 1,
                    'blog_category_id'=> $category?->id ?? 1,
                    'published_at'    => now()->subDays(7 - $i),
                    'is_featured'     => $i === 0,
                    'comments_enabled'=> true,
                ])
            );
        }
    }
}
