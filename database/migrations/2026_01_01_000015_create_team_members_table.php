<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        
        Schema::create('team_members', function (Blueprint $table) {
            $table->id();
            $table->json('name');                       // translatable
            $table->json('role');                       // translatable e.g. "مدير المبيعات"
            $table->json('description')->nullable();    // translatable
            $table->string('initials', 8)->nullable();  // "ك.ع"
            $table->string('badge_color')->nullable();  // hex or named
            $table->string('phone')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('email')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->unsignedInteger('position')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('team_members');
    }
};
