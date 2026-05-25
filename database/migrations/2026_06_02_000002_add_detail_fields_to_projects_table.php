<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->date('start_date')->nullable()->after('completion_date');
            $table->json('work_types')->nullable()->after('start_date');   // ["design","civil","cages",...]
            $table->json('videos')->nullable()->after('work_types');       // [{url,title_ar,title_en}]
        });
    }

    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn(['start_date', 'work_types', 'videos']);
        });
    }
};
