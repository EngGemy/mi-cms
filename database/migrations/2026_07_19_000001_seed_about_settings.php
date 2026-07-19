<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        $rows = [
            'hero_image_path'   => null,
            'video_url'         => null,
            'video_poster_path' => null,
            'teaser_image_path' => null,
            'seo' => [
                'title_ar' => 'عن إم آي للصناعات المعدنية — مصنّع بطاريات الدواجن المصري منذ 2008',
                'title_en' => 'About MI Metal Industries — Egyptian Poultry Cage Manufacturer Since 2008',
                'desc_ar'  => 'تعرّف على إم آي للصناعات المعدنية: 16+ سنة من التصنيع الأتوماتيكي لأقفاص الدواجن في دمياط، مصر. رؤيتنا، مهمتنا، خطنا الزمني، شهاداتنا، وكتالوج منتجاتنا.',
                'desc_en'  => 'Learn about MI Metal Industries: 16+ years manufacturing automatic poultry cage systems in Damietta, Egypt. Vision, mission, timeline, certifications, and catalog.',
            ],
            'hero' => [
                'eyebrow_ar' => 'منذ 2008 · دمياط، مصر',
                'eyebrow_en' => 'Since 2008 · Damietta, Egypt',
                'line1_ar'   => 'نصنع مستقبل',
                'line1_en'   => 'Engineering the Future',
                'line2_ar'   => 'تربية الدواجن.',
                'line2_en'   => 'of Poultry Farming.',
                'lead_ar'    => 'من ورشة صغيرة في دمياط إلى مصنع متكامل يخدم مزارع في مصر و9 أسواق تصدير — إم آي للصناعات المعدنية هي المعيار الذي تُقاس به بطاريات الدواجن الأتوماتيكية.',
                'lead_en'    => 'From a single workshop in Damietta to a fully integrated factory serving farms across Egypt and 9 export markets — MI Metal Industries is the benchmark for automatic poultry cage systems.',
                'fallback_image' => 'https://images.unsplash.com/photo-1504917595217-d4dc5ebe6122?w=1800&q=80&auto=format&fit=crop',
            ],
            'stats' => [
                ['value' => 16,   'suffix' => '+',  'label_ar' => 'سنة من التميّز',       'label_en' => 'Years of Excellence'],
                ['value' => 2000, 'suffix' => '+',  'label_ar' => 'عنبر منجَز',           'label_en' => 'Barns Completed'],
                ['value' => 18,   'suffix' => 'M+', 'label_ar' => 'طائر في منظوماتنا',   'label_en' => 'Birds Housed'],
                ['value' => 9,    'suffix' => '+',  'label_ar' => 'أسواق تصدير',         'label_en' => 'Export Markets'],
            ],
            'story' => [
                'eyebrow_ar' => 'رحلتنا',
                'eyebrow_en' => 'Our Journey',
                'title_ar'   => 'صُنع في دمياط. أثبت نفسه في مصر كلها.',
                'title_en'   => 'Built in Damietta. Proven Across Egypt.',
                'blurb_ar'   => 'بدأنا كورشة عائلية شغوفة بالجودة المعدنية، ونمونا لنصبح الرائد المصري في تصنيع بطاريات الدواجن الأتوماتيكية — نجمع بين المعرفة المحلية العميقة ومعايير الهندسة العالمية.',
                'blurb_en'   => 'What began as a family workshop dedicated to quality metalwork has grown into Egypt\'s leading manufacturer of automatic battery cage systems — combining deep local knowledge with global engineering standards.',
            ],
            'milestones' => [
                ['year' => '2008', 'icon' => 'building-2', 'title_ar' => 'التأسيس في دمياط', 'title_en' => 'Founded in Damietta', 'desc_ar' => 'تأسست إم آي للصناعات المعدنية في دمياط، مصر، لتنتج أولى بطاريات البياض الأتوماتيكية المصنوعة محلياً بتركيز على المتانة وسهولة الوصول للأسعار.', 'desc_en' => 'MI Metal Industries is established in Damietta, Egypt, producing the first locally manufactured automatic layer cage systems with a focus on durability and price accessibility.'],
                ['year' => '2012', 'icon' => 'wrench', 'title_ar' => 'التوسع في التسمين', 'title_en' => 'Expansion into Broilers', 'desc_ar' => 'توسّعنا في بطاريات التسمين H-Frame وأنظمة التغذية الأتوماتيكية، مضاعفةً الطاقة الإنتاجية ومُبرمين عقوداً مع كبرى الشركات التكاملية المصرية.', 'desc_en' => 'Expanded into H-Frame broiler cages and automatic feeding systems, doubling production capacity and securing contracts with major Egyptian integrators.'],
                ['year' => '2016', 'icon' => 'award', 'title_ar' => 'شهادات الجودة', 'title_en' => 'Quality Certifications', 'desc_ar' => 'حصلنا على شهادة ISO 9001 لإرساء إدارة الجودة الإنتاجية رسمياً. أولى شحنات التصدير إلى ليبيا تُعلن بداية امتدادنا الإقليمي.', 'desc_en' => 'Achieved ISO 9001 certification, formally establishing production quality management. First export shipments to Libya mark the start of regional expansion.'],
                ['year' => '2019', 'icon' => 'globe', 'title_ar' => 'شهادة CE والنمو التصديري', 'title_en' => 'CE Mark & Export Growth', 'desc_ar' => 'حصلنا على علامة CE لمنظومة الآلات، فُتحت أمامنا أسواق الخليج وأفريقيا. إيرادات التصدير تتجاوز 25% من إجمالي الإنتاج.', 'desc_en' => 'Obtained CE marking for machinery systems, opening Gulf and African markets. Export revenue exceeds 25% of total production.'],
                ['year' => '2022', 'icon' => 'cpu', 'title_ar' => 'منصة التحكم الذكية', 'title_en' => 'Smart Control Platform', 'desc_ar' => 'إطلاق MI-OS: منصة التحكم البيئي الخاصة بالإنترنت الأشياء، تُحضر الإدارة المناخية بالاستشعار الذكي لكل عنبر ننفّذه.', 'desc_en' => 'Launch of MI-OS: our IoT environmental control platform bringing smart climate management to every barn we deliver.'],
                ['year' => '2026', 'icon' => 'rocket', 'title_ar' => 'الريادة الإقليمية', 'title_en' => 'Regional Leadership', 'desc_ar' => 'نتوسّع في حلول المزارع الكبرى المتكاملة عبر منطقة الشرق الأوسط وأفريقيا. مركز بحث وتطوير جديد مكرّس لابتكار الإسكان المستدام للدواجن.', 'desc_en' => 'Expanding turnkey large-farm solutions across the Middle East and Africa. New R&D center dedicated to sustainable poultry housing innovation.'],
            ],
            'vmg' => [
                'eyebrow_ar' => 'غايتنا',
                'eyebrow_en' => 'Our Purpose',
                'title_ar'   => 'الرؤية. الرسالة. الأهداف.',
                'title_en'   => 'Vision. Mission. Goals.',
                'vision_title_ar' => 'الرؤية',
                'vision_title_en' => 'Vision',
                'vision_text_ar'  => 'أن نكون المصنّع الأكثر ثقةً لمنظومات إسكان الدواجن في العالم العربي — حيث كل عنبر نبنيه يرفع معيار رفاهية الحيوان والإنتاجية والاستدامة.',
                'vision_text_en'  => 'To be the most trusted manufacturer of poultry housing systems in the Arab world — where every barn we build raises the standard of animal welfare, productivity, and sustainability.',
                'mission_title_ar' => 'الرسالة',
                'mission_title_en' => 'Mission',
                'mission_text_ar'  => 'نصمّم وننتج ونركّب منظومات أقفاص دواجن أتوماتيكية متكاملة تساعد المربّين على تعظيم الناتج وتقليل الهدر والعمل وفق معايير الجودة العالمية — بأسعار تُتيح التوسّع التجاري.',
                'mission_text_en'  => 'We design, manufacture, and install end-to-end automatic poultry cage systems that help farmers maximize yield, minimize waste, and operate at global quality standards — at prices that make commercial scale accessible.',
                'goals_title_ar' => 'الأهداف',
                'goals_title_en' => 'Goals',
                'goals_text_ar'  => 'مضاعفة حضورنا في أسواق التصدير بحلول 2027، تحقيق تصنيع محايد كربونياً بحلول 2030، وتأسيس أول مركز مصري لأبحاث تقنيات الدواجن في دمياط.',
                'goals_text_en'  => 'To double export market penetration by 2027, achieve carbon-neutral manufacturing operations by 2030, and establish the first Egyptian poultry tech R&D center in Damietta.',
            ],
            'values_header' => [
                'eyebrow_ar' => 'ما يحرّكنا',
                'eyebrow_en' => 'What Drives Us',
                'title_ar'   => 'قيمنا الأساسية',
                'title_en'   => 'Our Core Values',
            ],
            'values' => [
                ['icon' => 'shield-check', 'title_ar' => 'جودة لا تُساوَم', 'title_en' => 'Uncompromising Quality', 'desc_ar' => 'كل لحام، كل قضيب مغلفَن، كل منظومة مُسلَّمة يجب أن تستوفي المعايير الدولية أو تتجاوزها. الجودة ليست ميزة — هي أساسنا.', 'desc_en' => 'Every weld, every galvanized bar, every delivered system must meet or exceed international standards. Quality is not a feature — it is our foundation.'],
                ['icon' => 'lightbulb', 'title_ar' => 'ابتكار مستمر', 'title_en' => 'Continuous Innovation', 'desc_ar' => 'من حساسات المناخ الذكية إلى أتمتة التغذية الدقيقة، نستثمر في البحث والتطوير حتى يبقى مربّونا في طليعة تطورات الصناعة.', 'desc_en' => 'From smart climate sensors to precision feeding automation, we invest in R&D so our farmers stay at the forefront of industry advances.'],
                ['icon' => 'handshake', 'title_ar' => 'التزام بالمواعيد', 'title_en' => 'On-Time Commitment', 'desc_ar' => 'نحترم تواريخ التسليم وجداول التركيب. الجدول الزمني لعنبرك هو عقدنا معك.', 'desc_en' => 'We respect delivery dates and installation schedules. Your barn timeline is our contract with you.'],
                ['icon' => 'users', 'title_ar' => 'شراكة حقيقية مع العميل', 'title_en' => 'True Customer Partnership', 'desc_ar' => 'لا نبيع المنتج ثم نختفي. فريقنا يقدم دعماً تقنياً مدى الحياة لكل منظومة نركّبها.', 'desc_en' => 'We do not sell and disappear. Our team provides lifetime technical support for every system we install.'],
                ['icon' => 'leaf', 'title_ar' => 'المسؤولية البيئية', 'title_en' => 'Environmental Responsibility', 'desc_ar' => 'عمليات الغلفنة الحلقية المغلقة، التصاميم موفّرة الطاقة، والتصنيع منخفض الهدر — مُضمَّنة في كل خط منتجاتنا.', 'desc_en' => 'Closed-loop galvanizing, energy-efficient designs, and low-waste manufacturing — built into every product line.'],
                ['icon' => 'star', 'title_ar' => 'التميّز التشغيلي', 'title_en' => 'Operational Excellence', 'desc_ar' => 'التصنيع الرشيق وثقافة الصفر عيوب والتحسين المستمر للعمليات — هذا ما يحكم أرضية مصنعنا كل يوم.', 'desc_en' => 'Lean manufacturing, zero-defect culture, and continuous process improvement — this governs our factory floor every day.'],
            ],
            'certs' => [
                'eyebrow_ar' => 'معتمد دولياً',
                'eyebrow_en' => 'Internationally Certified',
                'title_ar'   => 'شهادات الجودة والاعتمادات',
                'title_en'   => 'Certifications & Accreditations',
                'blurb_ar'   => 'إدارة الجودة وممارساتنا البيئية وعمليات التصنيع لدينا مُتحقّق منها بشكل مستقل من قِبل هيئات الاعتماد الدولية الرائدة.',
                'blurb_en'   => 'Our quality management, environmental practices, and manufacturing processes are independently verified by leading international certification bodies.',
            ],
            'video' => [
                'eyebrow_ar' => 'جولة المصنع',
                'eyebrow_en' => 'Factory Tour',
                'title_ar'   => 'شاهد كيف نصنع التميّز',
                'title_en'   => 'See How We Build Excellence',
                'blurb_ar'   => 'خذ جولة افتراضية داخل منشأتنا التصنيعية المتطورة في دمياط.',
                'blurb_en'   => 'Take a virtual walk through our state-of-the-art manufacturing facility in Damietta.',
                'badge'      => 'MI POULTRY · FACTORY',
                'caption'    => 'made in damietta',
                'headline_ar'=> 'هندسة دقيقة للدواجن الحديثة',
                'headline_en'=> 'Precision Engineering for Modern Poultry',
                'fallback_poster' => 'https://plus.unsplash.com/premium_photo-1661930553507-59420df08d82?w=1600&q=85&auto=format&fit=crop',
            ],
            'catalog' => [
                'eyebrow_ar' => 'منتجاتنا',
                'eyebrow_en' => 'Our Products',
                'title_ar'   => 'حمّل الكتالوج الشامل',
                'title_en'   => 'Download the Full Product Catalog',
                'blurb_ar'   => 'استعرض مجموعتنا الكاملة من أنظمة الأقفاص الأتوماتيكية وحلول التغذية والتحكم المناخي وحزم العنبر الجاهزة — في كتالوج واحد شامل.',
                'blurb_en'   => 'Explore our complete range of automatic cage systems, feeding solutions, climate control, and turnkey barn packages — all in one comprehensive catalog.',
                'download_ar'=> 'تحميل الكتالوج (PDF)',
                'download_en'=> 'Download Catalog (PDF)',
            ],
            'final_cta' => [
                'eyebrow_ar' => 'مستعد للبناء؟',
                'eyebrow_en' => 'Ready to Build?',
                'title_ar'   => 'لنصمّم عنبرك المثالي معاً.',
                'title_en'   => 'Let\'s Design Your Ideal Barn.',
                'blurb_ar'   => 'أخبرنا بحجم قطيعك وموقعك وأهدافك. سيصمّم فريق مهندسينا منظومة مُحسَّنة لظروفك تحديداً — مجاناً.',
                'blurb_en'   => 'Tell us your flock size, location, and goals. Our engineering team will design a system optimized for your specific conditions — at no charge.',
                'btn_ar'     => 'ابدأ استشارة مجانية',
                'btn_en'     => 'Start a Free Consultation',
            ],
            'teaser' => [
                'eyebrow_ar' => 'من نحن',
                'eyebrow_en' => 'About Us',
                'title_ar'   => 'مصنع إم آي للصناعات المعدنية',
                'title_en'   => 'MI Metal Industries Factory',
                'blurb_ar'   => 'تأسّسنا عام 2008 في دمياط بهدف واحد: تقديم حلول دواجن مصرية تضاهي الأوروبي في الجودة وتتفوّق عليه في ملاءمة البيئة المحلية والسعر.',
                'blurb_en'   => 'Founded in 2008 in Damietta with one goal: deliver Egyptian poultry solutions that match European quality and surpass it in local suitability and price.',
                'badge_ar'   => 'منذ 2008',
                'badge_en'   => 'Since 2008',
                'badge_years'=> '15+',
                'cta_ar'     => 'تعرّف علينا أكثر',
                'cta_en'     => 'Learn More About Us',
                'fallback_image' => 'https://plus.unsplash.com/premium_photo-1661930553507-59420df08d82?w=1600&q=85&auto=format&fit=crop',
            ],
        ];

        $payload = [];
        foreach ($rows as $name => $value) {
            $payload[] = [
                'group'   => 'about',
                'name'    => $name,
                'locked'  => false,
                'payload' => json_encode($value, JSON_UNESCAPED_UNICODE),
            ];
        }

        DB::table('settings')->upsert($payload, ['group', 'name']);
    }

    public function down(): void
    {
        DB::table('settings')->where('group', 'about')->delete();
    }
};
