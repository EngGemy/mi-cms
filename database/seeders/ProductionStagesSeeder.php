<?php

namespace Database\Seeders;

use App\Models\ProductionStage;
use Illuminate\Database\Seeder;

class ProductionStagesSeeder extends Seeder
{
    public function run(): void
    {
        $stages = [
            [
                'eyebrow'     => ['ar' => 'المرحلة الأولى', 'en' => 'Stage 1'],
                'title'       => ['ar' => 'التصميم الهندسي والمحاكاة', 'en' => 'Engineering Design & Simulation'],
                'description' => ['ar' => 'مخططات CAD ثلاثية الأبعاد، محاكاة تدفق الهواء والحرارة قبل البدء في التصنيع.',
                                  'en' => '3D CAD plans, airflow & thermal simulation before manufacturing.'],
            ],
            [
                'eyebrow'     => ['ar' => 'المرحلة الثانية', 'en' => 'Stage 2'],
                'title'       => ['ar' => 'قطع وتشكيل الصاج المغلفن', 'en' => 'Galvanized Sheet Cutting'],
                'description' => ['ar' => 'ماكينات CNC تقطع الصاج بدقة ±0.5mm. صاج مجلفن 275g/m² مقاوم للصدأ.',
                                  'en' => 'CNC cutting with ±0.5mm precision. 275g/m² galvanized rust-proof steel.'],
            ],
            [
                'eyebrow'     => ['ar' => 'المرحلة الثالثة', 'en' => 'Stage 3'],
                'title'       => ['ar' => 'اللحام الآلي عالي الدقة', 'en' => 'High-Precision Robotic Welding'],
                'description' => ['ar' => 'لحام MIG/MAG بآلات ألمانية. فحص بصري على كل وصلة قبل المرحلة التالية.',
                                  'en' => 'German MIG/MAG welding. Visual inspection on every joint.'],
            ],
            [
                'eyebrow'     => ['ar' => 'المرحلة الرابعة', 'en' => 'Stage 4'],
                'title'       => ['ar' => 'الجلفنة ومعالجة السطح', 'en' => 'Galvanization & Surface Treatment'],
                'description' => ['ar' => 'جلفنة بالغمس الساخن. عمر افتراضي 15+ سنة.',
                                  'en' => 'Hot-dip galvanization. 15+ year expected lifespan.'],
            ],
            [
                'eyebrow'     => ['ar' => 'المرحلة الخامسة', 'en' => 'Stage 5'],
                'title'       => ['ar' => 'فحص الجودة والاختبار', 'en' => 'Quality Inspection & Testing'],
                'description' => ['ar' => '3 مراحل فحص: مقاسات، تحمّل، وظيفي. كل بطارية تختبر تحت حمل أعلى من الواقعي.',
                                  'en' => 'Three-stage QA: dimensional, load, functional. Above-capacity testing.'],
            ],
            [
                'eyebrow'     => ['ar' => 'المرحلة السادسة', 'en' => 'Stage 6'],
                'title'       => ['ar' => 'التركيب الميداني والتشغيل', 'en' => 'Field Installation & Commissioning'],
                'description' => ['ar' => 'فريقنا الهندسي يُركّب في موقعك، يختبر كل نظام، يدرّب فريقك.',
                                  'en' => 'Our field team installs, tests every system, trains your staff.'],
            ],
        ];

        foreach ($stages as $i => $s) {
            ProductionStage::updateOrCreate(
                ['position' => $i + 1],
                array_merge($s, [
                    'stage_number' => $i + 1,
                    'is_active'    => true,
                ])
            );
        }
    }
}
