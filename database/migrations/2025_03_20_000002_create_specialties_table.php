<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('specialties', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->text('description')->nullable();
            $table->timestamps();
        });

        // الجدول الوسيط بين المختصين والتخصصات
        Schema::create('specialist_specialties', function (Blueprint $table) {
            $table->id();
            $table->foreignId('specialist_id')->constrained()->onDelete('cascade');
            $table->foreignId('specialty_id')->constrained()->onDelete('cascade');
            $table->timestamps();

            // منع التكرار
            $table->unique(['specialist_id', 'specialty_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('specialist_specialties');
        Schema::dropIfExists('specialties');
    }
};