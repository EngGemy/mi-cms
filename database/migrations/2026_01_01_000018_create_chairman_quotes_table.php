<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        
        Schema::create('chairman_quotes', function (Blueprint $table) {
            $table->id();
            $table->json('quote');                      // translatable
            $table->json('signature_name')->nullable(); // translatable
            $table->json('signature_role')->nullable(); // translatable
            $table->string('signature_role_en')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('chairman_quotes');
    }
};
