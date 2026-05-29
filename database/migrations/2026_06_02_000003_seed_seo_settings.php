<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        DB::table('settings')->upsert([
            ['group' => 'seo', 'name' => 'meta_title_ar',        'locked' => false, 'payload' => json_encode('MI · أقفاص الدواجن الأوتوماتيكية')],
            ['group' => 'seo', 'name' => 'meta_title_en',        'locked' => false, 'payload' => json_encode('MI · Automatic Poultry Cages')],
            ['group' => 'seo', 'name' => 'meta_description_ar',  'locked' => false, 'payload' => json_encode('نظم أقفاص الدواجن الأوتوماتيكية من MI — جودة عالية، أسعار منافسة.')],
            ['group' => 'seo', 'name' => 'meta_description_en',  'locked' => false, 'payload' => json_encode('MI Automatic Poultry Cages — high quality, competitive prices for modern poultry farms.')],
            ['group' => 'seo', 'name' => 'og_image_path',        'locked' => false, 'payload' => json_encode(null)],
            ['group' => 'seo', 'name' => 'google_analytics_id',  'locked' => false, 'payload' => json_encode(null)],
            ['group' => 'seo', 'name' => 'google_tag_manager_id','locked' => false, 'payload' => json_encode(null)],
        ], ['group', 'name']);
    }

    public function down(): void
    {
        DB::table('settings')->where('group', 'seo')->delete();
    }
};
