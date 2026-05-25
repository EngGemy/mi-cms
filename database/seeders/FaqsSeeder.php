<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Seeder;

class FaqsSeeder extends Seeder
{
    public function run(): void
    {
        $faqs = [
            ['q_ar' => 'كم يستغرق تنفيذ عنبر كامل من البداية للتشغيل؟', 'q_en' => 'How long does a full house take?',
             'a_ar' => 'في المتوسط 42 يومًا: 5 أيام دراسة، 25 يوم تصنيع، 12 يوم تركيب وتشغيل.', 'a_en' => '42 days average: 5 study, 25 manufacturing, 12 installation & commissioning.'],
            ['q_ar' => 'ما الذي يشمله الضمان وفترته؟', 'q_en' => 'What does the warranty cover?',
             'a_ar' => 'ضمان شامل 5 سنوات على الهيكل، 3 سنوات على المحركات، وسنة كاملة على الإلكترونيات.', 'a_en' => '5 years on structure, 3 on motors, 1 year on electronics. Includes labor.'],
            ['q_ar' => 'هل تتوفر قطع الغيار محليًا في مصر؟', 'q_en' => 'Are spare parts available locally?',
             'a_ar' => 'نعم. مخزون كامل في مصنع دمياط، وفرع تجاري في القاهرة.', 'a_en' => 'Yes. Full stock in Damietta + Cairo branch. 24h delivery nationwide.'],
            ['q_ar' => 'هل تقدّمون تمويلًا بنكيًا أو تقسيطًا؟', 'q_en' => 'Do you offer financing?',
             'a_ar' => 'نعم. شراكات مع بنوك زراعية لتمويل حتى 80% بمدد سداد تصل إلى 7 سنوات.', 'a_en' => 'Yes. Partnerships with agricultural banks: up to 80% financing, 7-year terms.'],
            ['q_ar' => 'هل تشمل الخدمة تدريب فريق العمل؟', 'q_en' => 'Do you train our staff?',
             'a_ar' => 'تدريب مكثّف لمدة أسبوع كامل في الموقع، ومتابعة مجانية 6 أشهر.', 'a_en' => 'One-week intensive on-site training + 6 months free follow-up.'],
            ['q_ar' => 'هل يمكن تخصيص النظام حسب احتياجاتي؟', 'q_en' => 'Can the system be customized?',
             'a_ar' => 'بالتأكيد. كل عنبر يُصمّم خصيصًا حسب أبعاد موقعك وطاقة الإنتاج المستهدفة.', 'a_en' => 'Absolutely. Each house is custom-designed to your site & target capacity.'],
        ];

        foreach ($faqs as $i => $f) {
            Faq::updateOrCreate(
                ['position' => $i + 1],
                [
                    'question'  => ['ar' => $f['q_ar'], 'en' => $f['q_en']],
                    'answer'    => ['ar' => $f['a_ar'], 'en' => $f['a_en']],
                    'position'  => $i + 1,
                    'is_active' => true,
                ]
            );
        }
    }
}
