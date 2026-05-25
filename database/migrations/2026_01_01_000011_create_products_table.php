<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->json('name');                       // translatable
            $table->json('summary')->nullable();        // translatable
            $table->json('description')->nullable();    // translatable (long)
            $table->json('badge')->nullable();          // translatable label
            $table->json('specs')->nullable();          // array of {key, value} translatable
            $table->json('seo_title')->nullable();
            $table->json('seo_description')->nullable();
            $table->unsignedInteger('position')->default(0);
            $table->boolean('is_active')->default(true);
            $table->boolean('is_featured')->default(false);
            $table->timestamps();
            $table->index(['is_active', 'position']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
