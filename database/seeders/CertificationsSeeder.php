<?php

namespace Database\Seeders;

use App\Models\Certification;
use Illuminate\Database\Seeder;

class CertificationsSeeder extends Seeder
{
    public function run(): void
    {
        $certs = [
            [
                'name'        => ['en' => 'ISO 9001:2015 — Quality Management',      'ar' => 'ISO 9001:2015 — إدارة الجودة'],
                'issuer'      => ['en' => 'Bureau Veritas',                           'ar' => 'بيورو فيريتاس'],
                'description' => ['en' => 'Certified quality management system covering design, manufacture, and installation of poultry cage systems.', 'ar' => 'نظام إدارة جودة معتمد يغطي تصميم وتصنيع وتركيب منظومات أقفاص الدواجن.'],
                'year'        => 2016,
                'position'    => 1,
            ],
            [
                'name'        => ['en' => 'CE Marking — Machinery Directive',         'ar' => 'شهادة CE — توجيه الآلات'],
                'issuer'      => ['en' => 'TÜV Rheinland',                            'ar' => 'TÜV راينلاند'],
                'description' => ['en' => 'European conformity mark confirming our automated feeding and cage systems meet EU safety standards.', 'ar' => 'علامة المطابقة الأوروبية التي تؤكد أن أنظمة التغذية والأقفاص الآلية لدينا تستوفي معايير السلامة الأوروبية.'],
                'year'        => 2019,
                'position'    => 2,
            ],
            [
                'name'        => ['en' => 'ISO 14001:2015 — Environmental Management', 'ar' => 'ISO 14001:2015 — الإدارة البيئية'],
                'issuer'      => ['en' => 'SGS Group',                                 'ar' => 'مجموعة SGS'],
                'description' => ['en' => 'Environmental management certification affirming our commitment to sustainable manufacturing and minimal ecological impact.', 'ar' => 'شهادة الإدارة البيئية التي تؤكد التزامنا بالتصنيع المستدام والحد الأدنى من الأثر البيئي.'],
                'year'        => 2020,
                'position'    => 3,
            ],
            [
                'name'        => ['en' => 'Egyptian Quality Mark — GOEIC',            'ar' => 'علامة الجودة المصرية — هيئة التقييس'],
                'issuer'      => ['en' => 'General Organization for Export & Import Control', 'ar' => 'الجهاز المركزي للتنظيم والإدارة'],
                'description' => ['en' => 'Egyptian national quality certification for agricultural equipment and livestock housing systems.', 'ar' => 'شهادة الجودة الوطنية المصرية للمعدات الزراعية وأنظمة الإيواء الزراعي.'],
                'year'        => 2014,
                'position'    => 4,
            ],
            [
                'name'        => ['en' => 'Hot-Dip Galvanizing Standard — EN ISO 1461', 'ar' => 'معيار الغلفنة الساخنة — EN ISO 1461'],
                'issuer'      => ['en' => 'Intertek Testing Services',                   'ar' => 'إنترتيك للاختبارات'],
                'description' => ['en' => 'Structural steel hot-dip galvanizing conformity ensuring 25+ year corrosion resistance for cage systems.', 'ar' => 'مطابقة الغلفنة الساخنة للفولاذ الإنشائي مما يضمن مقاومة التآكل لأكثر من 25 عاماً لأنظمة الأقفاص.'],
                'year'        => 2018,
                'position'    => 5,
            ],
            [
                'name'        => ['en' => 'Occupational Health & Safety — ISO 45001', 'ar' => 'الصحة والسلامة المهنية — ISO 45001'],
                'issuer'      => ['en' => 'Lloyd\'s Register',                         'ar' => 'سجل لويدز'],
                'description' => ['en' => 'Workplace safety management certification ensuring the highest standards of employee health and safety.', 'ar' => 'شهادة إدارة السلامة في مكان العمل التي تضمن أعلى معايير صحة الموظفين وسلامتهم.'],
                'year'        => 2022,
                'position'    => 6,
            ],
        ];

        foreach ($certs as $cert) {
            Certification::updateOrCreate(
                ['name->en' => $cert['name']['en']],
                array_merge($cert, ['is_active' => true])
            );
        }
    }
}
