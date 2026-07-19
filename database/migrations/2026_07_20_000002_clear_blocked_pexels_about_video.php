<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        // Remove blocked Pexels hotlink that returns 403
        DB::table('settings')
            ->where('group', 'about')
            ->where('name', 'video_url')
            ->where('payload', 'like', '%videos.pexels.com%')
            ->update(['payload' => json_encode(null)]);
    }

    public function down(): void
    {
        // no-op
    }
};
