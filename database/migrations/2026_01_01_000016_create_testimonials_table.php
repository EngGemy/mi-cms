<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        
        Schema::create('testimonials', function (Blueprint $table) {
            $table->id();
            $table->json('quote');                      // translatable
            $table->json('author_name');                // translatable
            $table->json('author_role')->nullable();    // translatable
            $table->string('initials', 8)->nullable();
            $table->string('avatar_color')->nullable();
            $table->unsignedTinyInteger('rating')->default(5);
            $table->unsignedInteger('position')->default(0);
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('testimonials');
    }
};
