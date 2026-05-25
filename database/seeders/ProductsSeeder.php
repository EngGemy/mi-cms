<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductsSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            [
                'name'    => ['ar' => 'بطاريات التسمين H-Frame', 'en' => 'H-Frame Broiler Cages'],
                'badge'   => ['ar' => 'الأكثر طلباً', 'en' => 'Best Seller'],
                'summary' => [
                    'ar' => 'نظام H-Frame متعدد الطوابق للتسمين الصناعي — أعلى معدلات نمو بأتمتة كاملة لإدارة السماد والطيور.',
                    'en' => 'Multi-tier H-Frame system for industrial broilers — highest growth rates with fully automated manure and bird conveyors.',
                ],
                'description' => [
                    'ar' => '<p>بطاريات H-Frame من إم آي هي الحل الأمثل للمزارع التجارية الكبرى. تتميز بهيكل فولاذي مجلفن بالكامل بسماكة 2.0 ملم، مع سيور ناقلة للسماد في كل طابق تقلل التلوث وتُحسّن صحة القطيع.</p><p>النظام مصمم لتحقيق أقصى كثافة تربية مع الحفاظ على أفضل مؤشرات رفاهية الطيور. تشمل الحزمة سيور التغذية الأوتوماتيكية، خطوط المياه بالنيبلات، وأنظمة تشغيل الكتاكيت الآلية.</p>',
                    'en' => '<p>MI H-Frame cages are the premier solution for large commercial farms. Built with 2.0mm fully galvanized steel frames and per-tier manure belts that minimize contamination and improve flock health.</p><p>Engineered for maximum stocking density while maintaining top welfare indicators. Package includes automatic feed belts, nipple waterlines, and automated chick loading systems.</p>',
                ],
                'specs' => [
                    'ar' => [
                        'السعة' => '96 طائر/وحدة',
                        'عدد الطوابق' => '3 – 5 طوابق',
                        'أبعاد الوحدة' => '1.95 × 0.65 × 1.75 م',
                        'الخامة' => 'فولاذ مجلفن 2.0 ملم',
                        'نظام السماد' => 'سيور ناقلة في كل طابق',
                        'نظام التغذية' => 'سيور أوتوماتيكية',
                        'نظام المياه' => 'نيبلات بصحن تجميع',
                        'معدل النمو' => '+5% فوق المعيار',
                    ],
                    'en' => [
                        'Capacity' => '96 birds/unit',
                        'Tiers' => '3 – 5 tiers',
                        'Unit dimensions' => '1.95 × 0.65 × 1.75 m',
                        'Material' => '2.0 mm galvanized steel',
                        'Manure system' => 'Per-tier conveyor belts',
                        'Feed system' => 'Automatic conveyor belts',
                        'Water system' => 'Nipple drinkers with drip cups',
                        'Growth rate' => '+5% above standard',
                    ],
                ],
                'is_featured' => true,
                'position'    => 1,
            ],
            [
                'name'    => ['ar' => 'بطاريات البياض A-Type', 'en' => 'A-Type Layer Cages'],
                'badge'   => ['ar' => 'سيريز A', 'en' => 'A-Series'],
                'summary' => [
                    'ar' => 'بطاريات بياض ثلاثية الطوابق بناقل بيض أوتوماتيكي مستمر، مغلفنة بالكامل ومقاومة للصدأ.',
                    'en' => 'Three-tier layer cages with continuous automatic egg conveyor belt. Fully galvanized and corrosion-resistant.',
                ],
                'description' => [
                    'ar' => '<p>بطاريات A-Type مصممة لمزارع البياض التجارية. تتميز بزاوية قفص مُحسَّنة (8°) تضمن انزلاق البيض فوراً إلى ناقل البيض الأوتوماتيكي، مما يقلل الكسر إلى أقل من 0.8%.</p><p>الهيكل من فولاذ مجلفن بالكامل بسماكة 1.8 ملم، مع أرضيات بسلك مغلفن PP لمنع إصابات الأرجل. كل وحدة مزودة بخط مياه مستقل وناقل علف سريع.</p>',
                    'en' => '<p>A-Type cages are engineered for commercial layer farms. The optimized cage angle (8°) ensures immediate egg roll-off to the automatic egg conveyor belt, reducing breakage below 0.8%.</p><p>Fully galvanized 1.8mm steel frame with PP-coated wire floors to prevent foot injuries. Each unit includes independent waterline and fast feed conveyor.</p>',
                ],
                'specs' => [
                    'ar' => [
                        'إنتاج البيض' => '12,400 بيضة/يوم (عنبر كامل)',
                        'معدل البقاء' => '98.2%',
                        'زاوية القفص' => '8 درجات',
                        'عدد الطوابق' => '3 – 4 طوابق',
                        'الخامة' => 'فولاذ مجلفن 1.8 ملم + PP',
                        'ناقل البيض' => 'أوتوماتيكي مستمر',
                        'كسر البيض' => 'أقل من 0.8%',
                        'أبعاد الوحدة' => '2.0 × 0.65 × 1.65 م',
                    ],
                    'en' => [
                        'Egg production' => '12,400 eggs/day (full house)',
                        'Survival rate' => '98.2%',
                        'Cage angle' => '8 degrees',
                        'Tiers' => '3 – 4 tiers',
                        'Material' => '1.8mm galvanized steel + PP',
                        'Egg conveyor' => 'Continuous automatic belt',
                        'Breakage rate' => 'Below 0.8%',
                        'Unit dimensions' => '2.0 × 0.65 × 1.65 m',
                    ],
                ],
                'is_featured' => true,
                'position'    => 2,
            ],
            [
                'name'    => ['ar' => 'أنظمة تغذية أوتوماتيكية', 'en' => 'Automatic Feeding Systems'],
                'badge'   => ['ar' => 'صناعي', 'en' => 'Industrial'],
                'summary' => [
                    'ar' => 'توزيع علف دقيق بالغرام عبر سيلو متّصل، جدولة وجبات متعددة، توفير 18% في استهلاك العلف.',
                    'en' => 'Gram-precise feed distribution via connected silo, multi-meal scheduling, 18% feed cost savings.',
                ],
                'description' => [
                    'ar' => '<p>نظام التغذية الأوتوماتيكي من إم آي يتكامل مباشرة مع صوامع الأعلاف، ويوزع العلف بدقة ±5 جرام في كل وحدة. يمكن برمجة 12 وجبة يومياً بكميات مختلفة حسب عمر الطائر.</p><p>يوفر النظام 18% من استهلاك العلف مقارنة بالتغذية اليدوية، ويقضي تماماً على الهدر الناجم عن الانسكاب. متوفر لكلا نوعي البطارية (تسمين وبياض).</p>',
                    'en' => '<p>MI automatic feeding system integrates directly with feed silos and distributes feed with ±5g precision per unit. Program up to 12 daily meals with different quantities based on bird age.</p><p>Saves 18% of feed consumption vs. manual feeding and eliminates spillage waste entirely. Available for both broiler and layer cage types.</p>',
                ],
                'specs' => [
                    'ar' => [
                        'دقة التوزيع' => '±5 جرام',
                        'وجبات يومية' => 'حتى 12 وجبة',
                        'التوفير في العلف' => '18%',
                        'سرعة الخط' => '3.5 م/ثانية',
                        'سعة الخزان' => '100 – 500 كجم',
                        'التوافق' => 'H-Frame و A-Type',
                        'التحكم' => 'PLC مبرمج',
                    ],
                    'en' => [
                        'Distribution accuracy' => '±5 grams',
                        'Daily meals' => 'Up to 12 meals',
                        'Feed savings' => '18%',
                        'Belt speed' => '3.5 m/s',
                        'Tank capacity' => '100 – 500 kg',
                        'Compatibility' => 'H-Frame & A-Type',
                        'Control' => 'Programmable PLC',
                    ],
                ],
                'is_featured' => false,
                'position'    => 3,
            ],
            [
                'name'    => ['ar' => 'تهوية أنفاق + Cooling Pad', 'en' => 'Tunnel Ventilation + Cooling Pad'],
                'badge'   => ['ar' => 'تهوية', 'en' => 'Ventilation'],
                'summary' => [
                    'ar' => 'مراوح تهوية أنفاق متغيرة السرعة (VFD) ولوحات تبريد أوروبية الصنع. خفض درجة الحرارة 8°م مقارنة بالخارج.',
                    'en' => 'Variable-speed VFD tunnel fans + European cooling pads. Temperature reduction up to 8°C vs. ambient.',
                ],
                'description' => [
                    'ar' => '<p>نظام التهوية الأنفاقية من إم آي يضمن تدفق هواء منتظم من نهاية إلى أخرى عبر العنبر بالكامل. المراوح متغيرة السرعة (VFD) توفر 30% من الطاقة مقارنة بالمراوح التقليدية.</p><p>لوحات التبريد الأوروبية عمق 150 ملم بتوزيع مياه موحّد تخفض درجة الحرارة 8°م مما يقلل الإجهاد الحراري ويرفع الإنتاجية. سرعة الهواء تصل إلى 3.5 م/ثانية.</p>',
                    'en' => '<p>MI tunnel ventilation system ensures uniform airflow from end to end across the entire house. VFD variable-speed fans save 30% power vs. conventional fans.</p><p>European cooling pads (150mm depth) with uniform water distribution reduce temperature by 8°C, minimizing heat stress and boosting productivity. Airspeed up to 3.5 m/s.</p>',
                ],
                'specs' => [
                    'ar' => [
                        'سرعة الهواء' => 'حتى 3.5 م/ثانية',
                        'خفض الحرارة' => '8°م مقارنة بالخارج',
                        'عمق لوحات التبريد' => '150 ملم (أوروبي)',
                        'توفير الطاقة' => '30%',
                        'نظام التحكم' => 'VFD (تحكم في السرعة)',
                        'الصوت' => 'أقل من 70 ديسيبل',
                        'العمر الافتراضي' => '15+ سنة',
                    ],
                    'en' => [
                        'Airspeed' => 'Up to 3.5 m/s',
                        'Temperature reduction' => '8°C below ambient',
                        'Cooling pad depth' => '150mm (European)',
                        'Power savings' => '30%',
                        'Control system' => 'VFD variable-speed drive',
                        'Noise level' => 'Below 70 dB',
                        'Service life' => '15+ years',
                    ],
                ],
                'is_featured' => false,
                'position'    => 4,
            ],
            [
                'name'    => ['ar' => 'منصة MI-OS للتحكم الذكي', 'en' => 'MI-OS Smart Control Platform'],
                'badge'   => ['ar' => 'منصة ذكية', 'en' => 'Smart Platform'],
                'summary' => [
                    'ar' => 'نظام تحكم IoT لحظي يراقب درجة الحرارة والرطوبة والغاز وصحة القطيع من أي مكان عبر التطبيق.',
                    'en' => 'Real-time IoT control system monitoring temperature, humidity, gas, and flock health from anywhere via app.',
                ],
                'description' => [
                    'ar' => '<p>منصة MI-OS هي الدماغ الذكي للعنبر الحديث. تجمع بيانات 32+ حساساً في الوقت الفعلي وتعرضها على لوحة تحكم سهلة القراءة — على الجهاز المحلي أو عبر التطبيق من أي مكان.</p><p>النظام يكتشف الشذوذات تلقائياً ويرسل تنبيهات فورية (SMS/تطبيق) قبل أن تتفاقم المشكلة. يُنتج تقارير أداء أسبوعية وشهرية لمتابعة مؤشرات FCR، الوفيات، ومعدل النمو.</p>',
                    'en' => '<p>MI-OS platform is the smart brain of the modern poultry house. It aggregates data from 32+ sensors in real-time and displays them on an easy-to-read dashboard — on the local device or anywhere via the app.</p><p>The system auto-detects anomalies and sends instant alerts (SMS/app) before problems escalate. Generates weekly and monthly performance reports tracking FCR, mortality, and growth rate indicators.</p>',
                ],
                'specs' => [
                    'ar' => [
                        'عدد الحساسات المدعومة' => '32+ حساس',
                        'التوفر' => '24/7/365',
                        'التنبيهات' => 'SMS + تطبيق فوري',
                        'التقارير' => 'أسبوعية + شهرية',
                        'واجهة العرض' => '7 بوصة + تطبيق',
                        'الاتصال' => 'Wi-Fi + 4G احتياطي',
                        'التكامل' => 'تهوية + تغذية + إضاءة',
                    ],
                    'en' => [
                        'Supported sensors' => '32+ sensors',
                        'Availability' => '24/7/365',
                        'Alerts' => 'Instant SMS + app',
                        'Reports' => 'Weekly + monthly',
                        'Display interface' => '7-inch + mobile app',
                        'Connectivity' => 'Wi-Fi + 4G backup',
                        'Integration' => 'Ventilation + feeding + lighting',
                    ],
                ],
                'is_featured' => true,
                'position'    => 5,
            ],
            [
                'name'    => ['ar' => 'صوامع الأعلاف والمخازن', 'en' => 'Feed Silos & Storage'],
                'badge'   => ['ar' => 'تخزين', 'en' => 'Storage'],
                'summary' => [
                    'ar' => 'صوامع علف مجلفنة بسعات 5–50 طن مع أنظمة تفريغ آلية وأبراج توزيع لكل عنبر.',
                    'en' => 'Galvanized feed silos in 5–50 ton capacities with automatic discharge and distribution towers per house.',
                ],
                'description' => [
                    'ar' => '<p>صوامع الأعلاف من إم آي مصنوعة من صفائح فولاذ مجلفن ثقيل الحجم (2.5 ملم)، مقاومة للعوامل الجوية وصممت لتحمل درجات الحرارة العالية في مصر والمنطقة العربية.</p><p>كل صومعة مزودة بمقياس مستوى إلكتروني، نظام تفريغ آلي بالسيور أو الهوائية، وفتحة فحص علوية. متوفرة بسعات من 5 إلى 50 طناً وتُركَّب على أساس خرساني أو إطار فولاذي.</p>',
                    'en' => '<p>MI feed silos are built from heavy-gauge galvanized steel sheets (2.5mm), weather-resistant and designed to withstand high temperatures in Egypt and the Arab region.</p><p>Each silo is equipped with an electronic level gauge, automatic belt or pneumatic discharge system, and a top inspection hatch. Available in 5 to 50-ton capacities, mounted on concrete base or steel frame.</p>',
                ],
                'specs' => [
                    'ar' => [
                        'نطاق السعة' => '5 – 50 طن',
                        'الخامة' => 'صلب مجلفن 2.5 ملم',
                        'نظام التفريغ' => 'سيور أو هوائي',
                        'مؤشر المستوى' => 'إلكتروني',
                        'الضمان' => '10 سنوات (هيكل)',
                        'التركيب' => 'قاعدة خرسانية / إطار فولاذي',
                        'شهادة الجودة' => 'ISO 9001:2015',
                    ],
                    'en' => [
                        'Capacity range' => '5 – 50 tons',
                        'Material' => '2.5mm galvanized steel',
                        'Discharge system' => 'Belt or pneumatic',
                        'Level indicator' => 'Electronic',
                        'Warranty' => '10 years (structure)',
                        'Installation' => 'Concrete base / steel frame',
                        'Quality certificate' => 'ISO 9001:2015',
                    ],
                ],
                'is_featured' => false,
                'position'    => 6,
            ],
        ];

        foreach ($items as $p) {
            Product::updateOrCreate(
                ['slug' => Str::slug($p['name']['en'])],
                array_merge($p, ['is_active' => true])
            );
        }
    }
}
