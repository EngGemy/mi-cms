<?php

namespace Database\Seeders;

use App\Models\ChairmanQuote;
use Illuminate\Database\Seeder;

class ChairmanQuotesSeeder extends Seeder
{
    public function run(): void
    {
        ChairmanQuote::updateOrCreate(
            ['is_active' => true],
            [
                'quote' => [
                    'ar' => 'من 2008 وإحنا بنشتغل على فكرة واحدة: صناعة دواجن مصرية تنافس عالميًا. كل عنبر بنسلّمه مش مجرد منتج — هو شراكة ومسؤولية، وكل عميل بيثق فينا هو دليل إن الجودة المصرية تقدر توصل لأي مكان في العالم.',
                    'en' => 'Since 2008 we have been working on one idea: an Egyptian poultry industry that competes globally. Every house we deliver is not just a product — it is a partnership and a responsibility, and every customer who trusts us proves that Egyptian quality can reach anywhere in the world.',
                ],
                'signature_name'   => ['ar' => 'إدارة إم آي', 'en' => 'MI Management'],
                'signature_role'   => ['ar' => 'الإدارة العامة', 'en' => 'General Management'],
                'signature_role_en'=> 'General Management',
                'is_active'        => true,
            ]
        );
    }
}
