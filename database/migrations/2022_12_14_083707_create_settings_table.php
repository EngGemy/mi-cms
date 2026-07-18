<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Idempotent stub: Spatie settings publish may recreate this filename.
 * The real settings table is created by 2026_01_01_000060_create_settings_table.
 * This migration must never fail deploy when the table already exists.
 */
return new class extends Migration {
    public function up(): void
    {
        if (! Schema::hasTable('settings')) {
            Schema::create('settings', function (Blueprint $table) {
                $table->id();
                $table->string('group')->index();
                $table->string('name');
                $table->boolean('locked')->default(false);
                $table->json('payload');
                $table->timestamps();
                $table->unique(['group', 'name']);
            });
        }
    }

    public function down(): void
    {
        // Intentionally empty — table is owned by the canonical 2026 migration.
    }
};
