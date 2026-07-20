<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

/**
 * Allow shorter houses from admin defaults (71 m).
 * Existing installs: update stored calculator settings if still on legacy 81.
 */
return new class extends Migration
{
    public function up(): void
    {
        $row = DB::table('settings')->where('group', 'calculator')->where('name', 'min_length')->first();
        if ($row && (float) json_decode($row->payload, true) >= 81) {
            DB::table('settings')->where('id', $row->id)->update([
                'payload' => json_encode(71),
                'updated_at' => now(),
            ]);
        }

        $def = DB::table('settings')->where('group', 'calculator')->where('name', 'default_length')->first();
        if ($def && (float) json_decode($def->payload, true) >= 81) {
            DB::table('settings')->where('id', $def->id)->update([
                'payload' => json_encode(71),
                'updated_at' => now(),
            ]);
        }
    }

    public function down(): void
    {
        // no-op — admin may have customized further
    }
};
