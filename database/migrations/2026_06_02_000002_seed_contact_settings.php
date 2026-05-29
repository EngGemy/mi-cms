<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        DB::table('settings')->upsert([
            ['group' => 'contact', 'name' => 'phone_primary', 'locked' => false, 'payload' => json_encode(env('MI_PHONE_PRIMARY', '+201030003186'))],
            ['group' => 'contact', 'name' => 'phone_support', 'locked' => false, 'payload' => json_encode(env('MI_PHONE_SUPPORT', '+201030003186'))],
            ['group' => 'contact', 'name' => 'whatsapp',      'locked' => false, 'payload' => json_encode(env('MI_WHATSAPP', '201030003186'))],
            ['group' => 'contact', 'name' => 'email',         'locked' => false, 'payload' => json_encode(env('MI_EMAIL', 'info@mi-poultry.com'))],
            ['group' => 'contact', 'name' => 'inbox',         'locked' => false, 'payload' => json_encode(env('MI_CONTACT_INBOX', 'sales@mi-poultry.com'))],
            ['group' => 'contact', 'name' => 'address_ar',    'locked' => false, 'payload' => json_encode(env('MI_ADDRESS_AR', 'دمياط · مصر'))],
            ['group' => 'contact', 'name' => 'address_en',    'locked' => false, 'payload' => json_encode(env('MI_ADDRESS_EN', 'Damietta · Egypt'))],
        ], ['group', 'name']);
    }

    public function down(): void
    {
        DB::table('settings')->where('group', 'contact')->delete();
    }
};
