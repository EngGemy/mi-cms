<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        
        Schema::create('production_stages', function (Blueprint $table) {
            $table->id();
            $table->string('stage_number');             // "01", "02"...
            $table->json('eyebrow')->nullable();        // "MARHALA 01 · ENGINEERING"
            $table->json('title');                      // translatable
            $table->json('description')->nullable();    // translatable
            $table->string('video_url')->nullable();    // optional video link
            $table->unsignedInteger('position')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('production_stages');
    }
};
