<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\ProjectPhase;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProjectsSeeder extends Seeder
{
    public function run(): void
    {
        $projects = [
            [
                'title'           => ['ar' => 'مزرعة الصحراء — 4 عنابر بياض', 'en' => 'Sahara Farm — 4 Layer Houses'],
                'client_name'     => ['ar' => 'الصحراء للدواجن', 'en' => 'Sahara Poultry'],
                'summary'         => ['ar' => 'مشروع بياض متكامل بسعة 240 ألف طائر في الرياض بنظام H-Frame أوتوماتيكي.', 'en' => 'Turnkey layer project with 240K bird capacity in Riyadh using fully automatic H-Frame system.'],
                'description'     => ['ar' => 'مشروع متكامل لإنتاج البيض بسعة 240 ألف طائر في منطقة الرياض. يشمل المشروع 4 عنابر بياض مجهّزة بنظام H-Frame أوتوماتيكي كامل: خطوط تغذية، جمع بيض أوتوماتيكي، تهوية نفقية، ولوحة تحكم MI-OS الذكية. تم التسليم في وقته مع تدريب فريق المزرعة.', 'en' => 'Turnkey integrated layer project with 240K bird capacity in the Riyadh region. The project includes 4 layer houses equipped with a fully automatic H-Frame system: feeding lines, automatic egg collection, tunnel ventilation, and the MI-OS smart control panel. Delivered on schedule with full farm team training.'],
                'category'        => 'layer',
                'location_code'   => 'الرياض، المملكة العربية السعودية',
                'capacity_birds'  => 240000,
                'area_m2'         => 4800,
                'barns_count'     => 4,
                'year'            => 2024,
                'completion_date' => '2024-06-15',
                'duration_months' => 8,
                'is_featured'     => true,
                'position'        => 1,
            ],
            [
                'title'           => ['ar' => 'الوطنية — مجمّع 8 عنابر تجاري', 'en' => 'Al-Watanya — 8-House Commercial Complex'],
                'client_name'     => ['ar' => 'الوطنية للدواجن', 'en' => 'Al-Watanya Poultry'],
                'summary'         => ['ar' => 'مجمّع تجاري ضخم بـ 8 عنابر وسعة 640 ألف طائر في المملكة العربية السعودية.', 'en' => 'Large-scale 8-house commercial complex with 640K bird capacity in Saudi Arabia.'],
                'description'     => ['ar' => 'مجمّع دواجن تجاري ضخم يضم 8 عنابر إنتاج متكاملة بسعة إجمالية 640 ألف طائر. نُفِّذ المشروع في المملكة العربية السعودية ويشمل منظومة تغذية مركزية، أنظمة تهوية نفقية متعددة، ومنصة تحكم مركزية. يُعدّ من أكبر المشاريع التي نفّذتها MI في السوق السعودي.', 'en' => 'A massive commercial poultry complex comprising 8 integrated production houses with a total capacity of 640K birds. Implemented in Saudi Arabia, the project includes a centralized feeding system, multiple tunnel ventilation systems, and a central control platform. One of the largest projects MI has executed in the Saudi market.'],
                'category'        => 'commercial',
                'location_code'   => 'المملكة العربية السعودية',
                'capacity_birds'  => 640000,
                'area_m2'         => 12800,
                'barns_count'     => 8,
                'year'            => 2024,
                'completion_date' => '2024-09-30',
                'duration_months' => 14,
                'is_featured'     => true,
                'position'        => 2,
            ],
            [
                'title'           => ['ar' => 'دواجن النيل — 6 عنابر متكاملة', 'en' => 'Nile Poultry — 6 Integrated Houses'],
                'client_name'     => ['ar' => 'دواجن النيل', 'en' => 'Nile Poultry'],
                'summary'         => ['ar' => 'مجمّع 6 عنابر بسعة 480 ألف طائر في دمياط بمنظومة بياض كاملة.', 'en' => 'Full 6-house complex with 480K bird capacity in Damietta — complete layer system.'],
                'description'     => ['ar' => 'مجمّع دواجن متكامل بمحافظة دمياط يضمّ 6 عنابر بياض بسعة إجمالية 480 ألف طائر. المشروع يتضمن بطاريات A-Type مغلفنة بالكامل، أنظمة جمع بيض أوتوماتيكية بطاقة 28 ألف بيضة يومياً، تهوية نفقية بمراوح 50 بوصة، ونظام إدارة بيئية MI-OS.', 'en' => 'An integrated poultry complex in Damietta governorate with 6 layer houses and a total capacity of 480K birds. The project includes fully galvanized A-Type cages, automatic egg collection systems at 28K eggs/day, tunnel ventilation with 50-inch fans, and MI-OS environmental management system.'],
                'category'        => 'layer',
                'location_code'   => 'دمياط، مصر',
                'capacity_birds'  => 480000,
                'area_m2'         => 9600,
                'barns_count'     => 6,
                'year'            => 2025,
                'completion_date' => '2025-03-20',
                'duration_months' => 10,
                'is_featured'     => true,
                'position'        => 3,
            ],
            [
                'title'           => ['ar' => 'مزارع الكبير — H-Frame 4 طوابق', 'en' => 'Kabir Farms — H-Frame 4-Tier Broilers'],
                'client_name'     => ['ar' => 'مزارع الكبير', 'en' => 'Kabir Farms'],
                'summary'         => ['ar' => 'عنابر تسمين H-Frame 4 طوابق بكثافة عالية في الشرقية بسعة 120 ألف طائر.', 'en' => 'High-density 4-tier H-Frame broiler houses in Sharqia with 120K bird capacity.'],
                'description'     => ['ar' => 'عنابر تسمين حديثة باستخدام نظام H-Frame عالي الكثافة بأربعة طوابق في محافظة الشرقية. تتميّز بكثافة إنتاجية عالية مع أنظمة تهوية متطوّرة وإضاءة مُوقَّتة للتحكم في معدلات النمو. سعة 120 ألف طائر دفعياً مع دورة إنتاج كل 45 يوم.', 'en' => 'Modern broiler houses using a high-density 4-tier H-Frame system in Sharqia governorate. Features high production density with advanced ventilation systems and timed lighting to control growth rates. Capacity of 120K birds per batch with a 45-day production cycle.'],
                'category'        => 'broiler',
                'location_code'   => 'الشرقية، مصر',
                'capacity_birds'  => 120000,
                'area_m2'         => 3600,
                'barns_count'     => 3,
                'year'            => 2025,
                'completion_date' => '2025-01-10',
                'duration_months' => 6,
                'is_featured'     => true,
                'position'        => 4,
            ],
            [
                'title'           => ['ar' => 'منظومة جمع بيض أوتوماتيكية — المنوفية', 'en' => 'Automatic Egg Collection System — Menofia'],
                'client_name'     => ['ar' => 'مزرعة المنوفية', 'en' => 'Menofia Farm'],
                'summary'         => ['ar' => 'نظام جمع بيض أوتوماتيكي بطاقة 12.4 ألف بيضة يومياً مع خط تصنيف.', 'en' => 'Automatic egg collection at 12,400 eggs/day with integrated grading line.'],
                'description'     => ['ar' => 'تركيب وتشغيل منظومة جمع بيض أوتوماتيكية متكاملة بطاقة 12,400 بيضة يومياً في مزرعة المنوفية. المنظومة تشمل حزام جمع البيض، مصعد نقل عمودي، ووحدة تصنيف البيض حسب الحجم والوزن. تقليل الكسر بنسبة 94% مقارنة بالجمع اليدوي.', 'en' => 'Installation and commissioning of an integrated automatic egg collection system at 12,400 eggs/day at Menofia Farm. The system includes an egg collection belt, vertical transfer elevator, and an egg grading unit by size and weight. Breakage reduced by 94% compared to manual collection.'],
                'category'        => 'machinery',
                'location_code'   => 'المنوفية، مصر',
                'capacity_birds'  => 60000,
                'area_m2'         => 1200,
                'barns_count'     => 2,
                'year'            => 2025,
                'completion_date' => '2025-05-01',
                'duration_months' => 3,
                'is_featured'     => false,
                'position'        => 5,
            ],
            [
                'title'           => ['ar' => 'القاهرة للدواجن — تسمين كثيف', 'en' => 'Cairo Poultry — Intensive Broilers'],
                'client_name'     => ['ar' => 'القاهرة للدواجن', 'en' => 'Cairo Poultry'],
                'summary'         => ['ar' => 'مشروع تسمين كثيف بالقاهرة الكبرى بسعة 180 ألف طائر مع تهوية نفقية.', 'en' => 'Intensive broiler project in Greater Cairo with 180K capacity and tunnel ventilation.'],
                'description'     => ['ar' => 'مشروع تسمين كثيف في القاهرة الكبرى بسعة 180 ألف طائر دفعياً موزّعة على 3 عنابر. يتميّز بنظام تهوية نفقي متكامل بمراوح 54 بوصة وPad Cooling لضمان درجة الحرارة المثالية في الصيف.', 'en' => 'Intensive broiler project in Greater Cairo with 180K batch capacity across 3 houses. Features integrated tunnel ventilation with 54-inch fans and Pad Cooling to maintain ideal temperatures in summer.'],
                'category'        => 'broiler',
                'location_code'   => 'القاهرة الكبرى، مصر',
                'capacity_birds'  => 180000,
                'area_m2'         => 5400,
                'barns_count'     => 3,
                'year'            => 2024,
                'completion_date' => '2024-11-15',
                'duration_months' => 7,
                'is_featured'     => false,
                'position'        => 6,
            ],
            [
                'title'           => ['ar' => 'أنظمة تهوية نفقية V-PRO', 'en' => 'V-PRO Tunnel Ventilation Systems'],
                'client_name'     => ['ar' => 'MI Factory', 'en' => 'MI Factory'],
                'summary'         => ['ar' => 'سلسلة V-PRO من مراوح التهوية النفقية وCooling Pad للعنابر الكبرى.', 'en' => 'V-PRO series tunnel ventilation fans and Cooling Pads for large commercial houses.'],
                'description'     => ['ar' => 'سلسلة V-PRO من أنظمة التهوية والتبريد الخاصة بـ MI — تشمل مراوح نفقية بقطر 54 و50 بوصة، ألواح Cooling Pad سيلولوز عالي الامتصاصية، وأنظمة تحكم أوتوماتيكية متصلة بـ MI-OS. صُمِّمت خصيصاً للمناخ الحار في مصر ومنطقة الخليج.', 'en' => "MI's V-PRO ventilation and cooling system series — includes tunnel fans in 54 and 50-inch diameters, high-absorbency cellulose Cooling Pads, and automatic control systems connected to MI-OS. Specifically designed for the hot climate of Egypt and the Gulf region."],
                'category'        => 'machinery',
                'location_code'   => 'دمياط، مصر',
                'capacity_birds'  => 0,
                'area_m2'         => null,
                'barns_count'     => null,
                'year'            => 2026,
                'completion_date' => '2026-01-01',
                'duration_months' => 2,
                'is_featured'     => false,
                'position'        => 7,
            ],
            [
                'title'           => ['ar' => 'بطاريات A-Type مغلفنة — دفعة 2026', 'en' => 'Galvanized A-Type Cages — 2026 Batch'],
                'client_name'     => ['ar' => 'MI Factory', 'en' => 'MI Factory'],
                'summary'         => ['ar' => 'تصنيع دفعة جديدة من بطاريات A-Type المغلفنة بالغمس الحار لموسم 2026.', 'en' => 'Production of new hot-dip galvanized A-Type cage batch for the 2026 season.'],
                'description'     => ['ar' => 'دفعة جديدة من بطاريات A-Type المغلفنة بالغمس الحار (Hot-Dip Galvanizing) لموسم 2026. تتميّز هذه الدفعة بتحسينات هيكلية في نظام التصريف وحزام جمع السبلة، مع استخدام فولاذ Q235 مطابق للمواصفات الدولية. متوفّرة بأحجام 3 و4 طوابق.', 'en' => 'New batch of hot-dip galvanized A-Type cages for the 2026 season. This batch features structural improvements to the drainage system and manure collection belt, using Q235 steel compliant with international specifications. Available in 3 and 4-tier configurations.'],
                'category'        => 'machinery',
                'location_code'   => 'دمياط، مصر',
                'capacity_birds'  => 0,
                'area_m2'         => null,
                'barns_count'     => null,
                'year'            => 2026,
                'completion_date' => '2026-03-01',
                'duration_months' => 4,
                'is_featured'     => false,
                'position'        => 8,
            ],
        ];

        foreach ($projects as $data) {
            $enTitle = $data['title']['en'];
            $slug    = Str::slug($enTitle);

            // ensure unique slug
            $base = $slug;
            $i = 1;
            while (Project::where('slug', $slug)->where('position', '!=', $data['position'])->exists()) {
                $slug = $base . '-' . $i++;
            }

            $project = Project::updateOrCreate(
                ['position' => $data['position']],
                array_merge($data, ['slug' => $slug, 'is_active' => true])
            );

            // Seed phases for each project
            $this->seedPhases($project);
        }
    }

    private function seedPhases(Project $project): void
    {
        $phases = [
            [
                'title'       => ['ar' => 'الإنشاءات والأعمال المدنية', 'en' => 'Civil & Construction Works'],
                'description' => ['ar' => 'أعمال الحفر والردم والأساسات، بناء الجدران الحاملة، وتجهيز أرضية العنبر بميول تصريف السوائل.', 'en' => 'Excavation, backfilling, foundations, load-bearing walls, and barn floor preparation with liquid drainage slopes.'],
                'icon'        => 'hammer',
                'status'      => 'completed',
                'position'    => 1,
            ],
            [
                'title'       => ['ar' => 'الكهرباء والتحكم الذكي', 'en' => 'Electrical & Smart Control'],
                'description' => ['ar' => 'تمديدات كهربائية صناعية، لوحات توزيع، أنظمة PLC، وربط حساسات المناخ بلوحة MI-OS.', 'en' => 'Industrial electrical wiring, distribution panels, PLC systems, and climate sensor integration with MI-OS.'],
                'icon'        => 'zap',
                'status'      => 'completed',
                'position'    => 2,
            ],
            [
                'title'       => ['ar' => 'تركيب البطاريات والأقفاص', 'en' => 'Cage & Battery Installation'],
                'description' => ['ar' => 'تركيب بطاريات A-Type أو H-Frame، ضبط الميول، تثبيت خطوط التغذية والمياه، وفحص الجلفنة.', 'en' => 'Installation of A-Type or H-Frame cages, slope calibration, feeding/water line fixation, and galvanizing inspection.'],
                'icon'        => 'grid-3x3',
                'status'      => 'completed',
                'position'    => 3,
            ],
            [
                'title'       => ['ar' => 'التبريد والتهوية', 'en' => 'Cooling & Ventilation'],
                'description' => ['ar' => 'تركيب مراوح نفقية، ألواح Cooling Pad، منافذ هواء، واختبار الضغط الموجب داخل العنبر.', 'en' => 'Tunnel fan installation, Cooling Pads, air inlets, and positive pressure testing inside the house.'],
                'icon'        => 'wind',
                'status'      => 'completed',
                'position'    => 4,
            ],
            [
                'title'       => ['ar' => 'أنظمة التغذية والمياه', 'en' => 'Feeding & Water Systems'],
                'description' => ['ar' => 'تركيب خطوط التغذية الأوتوماتيكية، خزانات العلف، نظام نيبِل للمياه، واختبار التدفق.', 'en' => 'Automatic feeding line installation, feed silos, nipple drinking systems, and flow testing.'],
                'icon'        => 'droplets',
                'status'      => 'completed',
                'position'    => 5,
            ],
            [
                'title'       => ['ar' => 'التشطيبات والتسليم', 'en' => 'Finishing & Handover'],
                'description' => ['ar' => 'تنظيف نهائي، اختبارات تشغيل شاملة، تدريب فريق المزرعة، وتسليم المفاتيح.', 'en' => 'Final cleaning, comprehensive commissioning tests, farm team training, and key handover.'],
                'icon'        => 'check-circle',
                'status'      => 'completed',
                'position'    => 6,
            ],
        ];

        // For machinery projects, use slightly different phases
        if (in_array($project->category, ['machinery'])) {
            $phases = [
                [
                    'title'       => ['ar' => 'التصميم الهندسي', 'en' => 'Engineering Design'],
                    'description' => ['ar' => 'رسم CAD ثلاثي الأبعاد، محاكاة التدفق الهوائي، واختيار المواد حسب المعايير.', 'en' => '3D CAD design, airflow simulation, and material selection per standards.'],
                    'icon'        => 'pen-tool',
                    'status'      => 'completed',
                    'position'    => 1,
                ],
                [
                    'title'       => ['ar' => 'القطع والتشكيل المعدني', 'en' => 'Cutting & Metal Forming'],
                    'description' => ['ar' => 'قص وثني وثقب الفولاذ بأبعاد ±0.5mm باستخدام CNC.', 'en' => 'Steel cutting, bending, and punching to ±0.5mm tolerances using CNC.'],
                    'icon'        => 'scissors',
                    'status'      => 'completed',
                    'position'    => 2,
                ],
                [
                    'title'       => ['ar' => 'الغلفنة والمعالجة السطحية', 'en' => 'Galvanizing & Surface Treatment'],
                    'description' => ['ar' => 'غمس حار بالزنك بطبقة 80-120 ميكرون لضمان 15+ سنة عمر افتراضي.', 'en' => 'Hot-dip zinc galvanizing with 80-120 micron layer for 15+ year service life.'],
                    'icon'        => 'shield-check',
                    'status'      => 'completed',
                    'position'    => 3,
                ],
                [
                    'title'       => ['ar' => 'التجميع والاختبار', 'en' => 'Assembly & Testing'],
                    'description' => ['ar' => 'تجميع المكونات، ضبط الأبعاد، واختبار الأحمال الديناميكية.', 'en' => 'Component assembly, dimensional calibration, and dynamic load testing.'],
                    'icon'        => 'settings',
                    'status'      => 'completed',
                    'position'    => 4,
                ],
                [
                    'title'       => ['ar' => 'التغليف والشحن', 'en' => 'Packaging & Shipping'],
                    'description' => ['ar' => 'تغليف مقوّى للتصدير، تحميل الحاويات، وإصدار شهادات الجودة.', 'en' => 'Reinforced export packaging, container loading, and quality certification issuance.'],
                    'icon'        => 'package',
                    'status'      => 'completed',
                    'position'    => 5,
                ],
            ];
        }

        foreach ($phases as $phase) {
            $project->phases()->updateOrCreate(
                ['position' => $phase['position']],
                $phase
            );
        }
    }
}
