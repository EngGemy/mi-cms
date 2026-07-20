<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

/**
 * Factory line products: fans, concrete works, windows, drinkers.
 * Safe to re-run — updates by slug.
 */
class FactoryProductsSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            [
                'slug' => 'rear-exhaust-fans',
                'category' => 'ventilation',
                'name' => ['ar' => 'شفاطات خلفية للعنابر', 'en' => 'Rear Exhaust Fans'],
                'badge' => ['ar' => 'تهوية', 'en' => 'Ventilation'],
                'summary' => [
                    'ar' => 'شفاطات تهوية أنفاق عالية الكفاءة بسرعات متغيرة (VFD) — مناسبة لعنابر التسمين والبياض.',
                    'en' => 'High-efficiency tunnel exhaust fans with VFD speed control — for broiler and layer houses.',
                ],
                'description' => [
                    'ar' => '<p>شفاطات خلفية من تصنيع إم آي بتصاميم مناسبة للبيئة المصرية. محركات موثوقة، شفرات متوازنة، وإطارات مجلفنة مقاومة للصدأ.</p><p>تتوفر بقدرات متعددة حسب حجم العنبر وعدد الطيور، مع إمكانية الربط بمنصة التحكم MI-OS.</p>',
                    'en' => '<p>MI rear exhaust fans engineered for Egyptian farm conditions. Reliable motors, balanced blades, and galvanized corrosion-resistant frames.</p><p>Multiple capacities available by house size and bird count, with optional MI-OS control integration.</p>',
                ],
                'specs' => [
                    'ar' => [
                        'النوع' => 'شفاط نفق خلفي',
                        'التحكم' => 'VFD / يدوي',
                        'الخامة' => 'إطار مجلفن',
                        'التركيب' => 'جدار خلفي للعنبر',
                    ],
                    'en' => [
                        'Type' => 'Rear tunnel exhaust',
                        'Control' => 'VFD / manual',
                        'Material' => 'Galvanized frame',
                        'Install' => 'House rear wall',
                    ],
                ],
                'is_featured' => true,
                'position' => 20,
            ],
            [
                'slug' => 'poultry-house-windows',
                'category' => 'windows',
                'name' => ['ar' => 'شبابيك هواء للعنابر', 'en' => 'Poultry House Air Inlets'],
                'badge' => ['ar' => 'تهوية', 'en' => 'Ventilation'],
                'summary' => [
                    'ar' => 'شبابيك / فتحات هواء جانبية مضبوطة لتوزيع هواء منتظم داخل العنبر مع أنظمة التهوية النفقية.',
                    'en' => 'Side air inlets for even airflow in tunnel-ventilated poultry houses.',
                ],
                'description' => [
                    'ar' => '<p>شبابيك هواء مصممة للعمل مع الشفاطات الخلفية ولوحات التبريد. تفتح وتغلق وفق ضغط الهواء أو التحكم الآلي.</p>',
                    'en' => '<p>Air inlets designed to work with rear fans and cooling pads. Open/close by static pressure or automatic control.</p>',
                ],
                'specs' => [
                    'ar' => [
                        'الموضع' => 'جدران جانبية',
                        'التشغيل' => 'يدوي / آلي',
                        'التوافق' => 'تهوية أنفاق + Cooling Pad',
                    ],
                    'en' => [
                        'Position' => 'Side walls',
                        'Operation' => 'Manual / automatic',
                        'Compatible' => 'Tunnel + cooling pad',
                    ],
                ],
                'is_featured' => false,
                'position' => 21,
            ],
            [
                'slug' => 'nipple-drinkers',
                'category' => 'drinkers',
                'name' => ['ar' => 'سقايات وخطوط مياه', 'en' => 'Nipple Drinkers & Waterlines'],
                'badge' => ['ar' => 'مياه', 'en' => 'Water'],
                'summary' => [
                    'ar' => 'خطوط مياه بنيبلات وصحون تجميع — توزيع منتظم وتقليل الهدر داخل البطاريات والعنابر.',
                    'en' => 'Nipple drinker waterlines with drip cups — even distribution and less waste in cages and houses.',
                ],
                'description' => [
                    'ar' => '<p>أنظمة سقاية متكاملة: نيبلات، صحون، منظمات ضغط، وفلاتر. مناسبة لبطاريات التسمين والبياض.</p>',
                    'en' => '<p>Complete drinker systems: nipples, cups, pressure regulators, and filters. For broiler and layer cages.</p>',
                ],
                'specs' => [
                    'ar' => [
                        'النوع' => 'نيبلات + صحن تجميع',
                        'الضغط' => 'منظم ضغط قابل للضبط',
                        'التوافق' => 'H-Frame / A-Type / أرضي',
                    ],
                    'en' => [
                        'Type' => 'Nipples + drip cup',
                        'Pressure' => 'Adjustable regulator',
                        'Compatible' => 'H-Frame / A-Type / floor',
                    ],
                ],
                'is_featured' => false,
                'position' => 22,
            ],
            [
                'slug' => 'concrete-house-works',
                'category' => 'concrete',
                'name' => ['ar' => 'أعمال خرسانة وأساسات العنبر', 'en' => 'House Concrete & Foundations'],
                'badge' => ['ar' => 'إنشاءات', 'en' => 'Civil works'],
                'summary' => [
                    'ar' => 'تنفيذ أساسات وخرسانة أرضيات وجدران العنبر وفق المخطط الهندسي — جاهزية لاستلام البطاريات والمعدات.',
                    'en' => 'Foundations, floor slabs, and house concrete per engineering drawings — ready for cages and equipment.',
                ],
                'description' => [
                    'ar' => '<p>ننفذ أعمال الخرسانة المرتبطة بمشروع العنبر: أساسات، أرضيات، قواعد المعدات، وفق المواصفات المتفق عليها مع العميل.</p>',
                    'en' => '<p>We execute project concrete works: foundations, floors, and equipment bases per agreed specs with the client.</p>',
                ],
                'specs' => [
                    'ar' => [
                        'النطاق' => 'أساسات + أرضيات + قواعد',
                        'المرجع' => 'مخطط هندسي معتمد',
                        'التسليم' => 'جاهز لتركيب المعدات',
                    ],
                    'en' => [
                        'Scope' => 'Foundations + floors + bases',
                        'Reference' => 'Approved engineering drawings',
                        'Handover' => 'Ready for equipment install',
                    ],
                ],
                'is_featured' => false,
                'position' => 23,
            ],
        ];

        foreach ($items as $item) {
            Product::updateOrCreate(
                ['slug' => $item['slug']],
                [
                    'category' => $item['category'],
                    'name' => $item['name'],
                    'badge' => $item['badge'],
                    'summary' => $item['summary'],
                    'description' => $item['description'],
                    'specs' => $item['specs'],
                    'is_featured' => $item['is_featured'],
                    'is_active' => true,
                    'position' => $item['position'],
                ]
            );
        }
    }
}
