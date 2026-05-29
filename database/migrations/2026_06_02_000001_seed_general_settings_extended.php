<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        DB::table('settings')->upsert([
            ['group' => 'general', 'name' => 'site_name',    'locked' => false, 'payload' => json_encode('MI Automatic Poultry Cages')],
            ['group' => 'general', 'name' => 'logo_path',    'locked' => false, 'payload' => json_encode(null)],
            ['group' => 'general', 'name' => 'favicon_path', 'locked' => false, 'payload' => json_encode(null)],
            ['group' => 'general', 'name' => 'facebook_url', 'locked' => false, 'payload' => json_encode(null)],
            ['group' => 'general', 'name' => 'instagram_url','locked' => false, 'payload' => json_encode(null)],
            ['group' => 'general', 'name' => 'youtube_url',  'locked' => false, 'payload' => json_encode(null)],
            ['group' => 'general', 'name' => 'twitter_url',  'locked' => false, 'payload' => json_encode(null)],
            ['group' => 'general', 'name' => 'linkedin_url', 'locked' => false, 'payload' => json_encode(null)],
        ], ['group', 'name']);
    }

    public function down(): void
    {
        DB::table('settings')
            ->where('group', 'general')
            ->whereIn('name', ['site_name', 'logo_path', 'favicon_path', 'facebook_url', 'instagram_url', 'youtube_url', 'twitter_url', 'linkedin_url'])
            ->delete();
    }
};
