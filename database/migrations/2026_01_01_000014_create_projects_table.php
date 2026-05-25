<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->json('title');                      // translatable
            $table->json('client_name')->nullable();    // translatable
            $table->json('description')->nullable();    // translatable
            $table->string('category');                 // layer | broiler | commercial | machinery
            $table->string('location_code')->nullable(); // "DAMIETTA · 480K BIRDS · 2025"
            $table->unsignedInteger('capacity_birds')->nullable();
            $table->unsignedSmallInteger('year')->nullable();
            $table->unsignedInteger('position')->default(0);
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->index(['category', 'is_active']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
