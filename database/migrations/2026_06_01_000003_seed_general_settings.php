<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        DB::table('settings')->upsert([
            [
                'group'   => 'general',
                'name'    => 'catalog_pdf_url',
                'locked'  => false,
                'payload' => json_encode(null),
            ],
        ], ['group', 'name']);
    }

    public function down(): void
    {
        DB::table('settings')
            ->where('group', 'general')
            ->where('name', 'catalog_pdf_url')
            ->delete();
    }
};
