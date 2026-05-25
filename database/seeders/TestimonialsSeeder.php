<?php

namespace Database\Seeders;

use App\Models\Testimonial;
use Illuminate\Database\Seeder;

class TestimonialsSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            [
                'initials'    => 'س.ع',
                'avatar_color'=> '#C8102E',
                'author_name' => ['ar' => 'سامي العتيبي', 'en' => 'Sami Al-Otaibi'],
                'author_role' => ['ar' => 'المدير التنفيذي · الصحراء للدواجن', 'en' => 'CEO · Sahara Poultry'],
                'quote'       => ['ar' => 'بعد 18 شهر، خفّضنا تكلفة البيضة 24% ورفعنا الإنتاج 45 ألف بيضة يوميًا.',
                                  'en' => 'After 18 months, we cut egg cost by 24% and added 45K eggs/day to production.'],
                'rating'      => 5,
            ],
            [
                'initials'    => 'م.ر',
                'avatar_color'=> '#1A1611',
                'author_name' => ['ar' => 'محمد رضا', 'en' => 'Mohammed Reda'],
                'author_role' => ['ar' => 'صاحب مزارع · المنصورة', 'en' => 'Farm Owner · Mansoura'],
                'quote'       => ['ar' => 'التزام بالمواعيد، جودة تصنيع متفوّقة، وأسعار منافسة. شغّلنا عنبرين خلال 6 أشهر.',
                                  'en' => 'On-time delivery, superior build quality, competitive pricing. Two houses running in 6 months.'],
                'rating'      => 5,
            ],
            [
                'initials'    => 'ع.ك',
                'avatar_color'=> '#B8945C',
                'author_name' => ['ar' => 'عادل كمال', 'en' => 'Adel Kamal'],
                'author_role' => ['ar' => 'مدير الإنتاج · مزارع الكبير', 'en' => 'Production Manager · Kabir Farms'],
                'quote'       => ['ar' => 'الدعم الفني 24/7 ليس شعارًا. قطع الغيار متوفرة، والمهندسون يعرفون كل تفصيلة.',
                                  'en' => '24/7 support is not a slogan. Spare parts in stock, engineers know every detail.'],
                'rating'      => 5,
            ],
            [
                'initials'    => 'ر.ح',
                'avatar_color'=> '#3B5B47',
                'author_name' => ['ar' => 'رامي حسني', 'en' => 'Ramy Hosny'],
                'author_role' => ['ar' => 'مالك · شركة دواجن النيل', 'en' => 'Owner · Nile Poultry'],
                'quote'       => ['ar' => 'منصة MI-OS غيّرت طريقة إدارتنا. ROI في 14 شهر.',
                                  'en' => 'MI-OS changed how we manage. ROI in 14 months.'],
                'rating'      => 5,
            ],
        ];

        foreach ($items as $i => $t) {
            Testimonial::updateOrCreate(
                ['position' => $i + 1],
                array_merge($t, ['position' => $i + 1, 'is_active' => true])
            );
        }
    }
}
