<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('project_stages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained()->cascadeOnDelete();
            $table->json('title');                         // translatable
            $table->json('description')->nullable();       // translatable
            $table->date('started_at')->nullable();
            $table->date('completed_at')->nullable();
            $table->unsignedInteger('position')->default(0);
            $table->boolean('is_done')->default(true);
            $table->timestamps();

            $table->index(['project_id', 'position']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('project_stages');
    }
};
