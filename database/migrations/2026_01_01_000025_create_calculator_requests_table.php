<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        
        Schema::create('calculator_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('contact_submission_id')->nullable()->constrained()->nullOnDelete();
            $table->decimal('length', 6, 2);
            $table->decimal('width', 6, 2);
            $table->decimal('height', 6, 2);
            $table->unsignedTinyInteger('floors');
            $table->unsignedTinyInteger('lines');
            $table->unsignedInteger('bird_count')->nullable();
            $table->decimal('grand_total', 14, 2)->nullable();
            $table->json('breakdown')->nullable();      // full computation snapshot
            $table->string('locale', 8)->default('ar');
            $table->string('ip_address', 45)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('calculator_requests');
    }
};
