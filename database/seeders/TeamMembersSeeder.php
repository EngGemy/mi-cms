<?php

namespace Database\Seeders;

use App\Models\TeamMember;
use Illuminate\Database\Seeder;

class TeamMembersSeeder extends Seeder
{
    public function run(): void
    {
        $team = [
            [
                'name'        => ['ar' => 'م. كريم العش', 'en' => 'Eng. Karim El-Esh'],
                'role'        => ['ar' => 'مدير المبيعات', 'en' => 'Sales Manager'],
                'description' => ['ar' => 'عروض أسعار رسمية مفصّلة، دراسات جدوى، وتخطيط مشاريع جديدة. خبرة 12+ سنة.',
                                  'en' => 'Detailed quotes, feasibility studies, project planning. 12+ years experience.'],
                'phone'       => '+201030003186',
                'whatsapp'    => '201030003186',
                'initials'    => 'ك.ع',
                'badge_color' => '#C8102E',
                'is_featured' => true,
            ],
            [
                'name'        => ['ar' => 'قسم الدعم الفني', 'en' => 'Technical Support'],
                'role'        => ['ar' => 'الدعم الفني · 24/7', 'en' => 'Field Technical Support · 24/7'],
                'description' => ['ar' => 'استجابة خلال 4 ساعات لمحافظات الدلتا. قطع غيار محلية + فريق هندسي.',
                                  'en' => '4-hour response in Delta governorates. Local spare parts + engineering team.'],
                'phone'       => '+201030003186',
                'whatsapp'    => '201030003186',
                'initials'    => 'د.ف',
                'badge_color' => '#1A1611',
                'is_featured' => false,
            ],
            [
                'name'        => ['ar' => 'قسم خدمة العملاء', 'en' => 'Customer Service'],
                'role'        => ['ar' => 'متابعة العملاء والصيانة', 'en' => 'Customer & Maintenance'],
                'description' => ['ar' => 'متابعة ما بعد البيع، جدولة الصيانة الدورية، الاستفسارات.',
                                  'en' => 'After-sales follow-up, scheduled maintenance, inquiries.'],
                'phone'       => '+201030003186',
                'whatsapp'    => '201030003186',
                'initials'    => 'خ.ع',
                'badge_color' => '#3B5B47',
                'is_featured' => false,
            ],
        ];

        foreach ($team as $i => $m) {
            TeamMember::updateOrCreate(
                ['phone' => $m['phone'], 'position' => $i + 1],
                array_merge($m, ['position' => $i + 1, 'is_active' => true])
            );
        }
    }
}
