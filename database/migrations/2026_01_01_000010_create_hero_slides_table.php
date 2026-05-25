<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        
        Schema::create('hero_slides', function (Blueprint $table) {
            $table->id();
            $table->json('label')->nullable();          // translatable: "للمزارع التجارية" etc.
            $table->string('image_url')->nullable();    // optional direct URL fallback
            $table->unsignedInteger('position')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->index(['is_active', 'position']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hero_slides');
    }
};
