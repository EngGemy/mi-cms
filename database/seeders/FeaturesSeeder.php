<?php

namespace Database\Seeders;

use App\Models\Feature;
use Illuminate\Database\Seeder;

class FeaturesSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            [
                'title' => ['ar' => 'تحكم آلي بالعنبر كاملاً', 'en' => 'Full Automatic House Control'],
                'description' => ['ar' => 'تغذية، تهوية، إضاءة، تبريد، جمع بيض — كل شيء يعمل وفق جدول مبرمج.',
                                  'en' => 'Feeding, ventilation, lighting, cooling, egg collection — all programmed.'],
                'icon' => 'heroicon-o-cpu-chip',
            ],
            [
                'title' => ['ar' => 'رؤية لحظية لكل قطيع', 'en' => 'Live Flock Visibility'],
                'description' => ['ar' => 'منصة MI-OS تعرض درجة الحرارة، استهلاك العلف، أداء القطيع، والتنبيهات على شاشة واحدة.',
                                  'en' => 'MI-OS shows temperature, feed consumption, flock performance, alerts — all in one screen.'],
                'icon' => 'heroicon-o-eye',
            ],
            [
                'title' => ['ar' => 'ضمان شامل ومتابعة', 'en' => 'Full Warranty & Support'],
                'description' => ['ar' => 'ضمان 5 سنوات شامل، مخزون قطع غيار محلي في دمياط، وفريق هندسي ميداني جاهز.',
                                  'en' => '5-year full warranty, local spare parts stock in Damietta, field engineering team on call.'],
                'icon' => 'heroicon-o-shield-check',
            ],
        ];

        foreach ($items as $i => $f) {
            Feature::updateOrCreate(
                ['position' => $i + 1],
                array_merge($f, ['is_active' => true])
            );
        }
    }
}
