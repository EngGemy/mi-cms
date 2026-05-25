<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->string('slug')->unique()->nullable()->after('title');
            $table->json('summary')->nullable()->after('slug');          // translatable short card desc
            $table->string('video_url')->nullable()->after('description'); // YouTube/Vimeo or uploaded path
            $table->date('completion_date')->nullable()->after('year');
            $table->unsignedInteger('area_m2')->nullable()->after('capacity_birds');
            $table->unsignedSmallInteger('barns_count')->nullable()->after('area_m2');
        });
    }

    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn(['slug', 'summary', 'video_url', 'completion_date', 'area_m2', 'barns_count']);
        });
    }
};
