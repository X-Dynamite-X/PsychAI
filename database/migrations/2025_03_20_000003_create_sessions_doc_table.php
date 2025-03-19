<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sessions_doc', function (Blueprint $table) {
            $table->id();
            $table->foreignId('specialist_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->date('date');
            $table->time('time');
            $table->enum('status', ['pending', 'confirmed', 'completed', 'cancelled'])
                  ->default('pending')
                  ->comment('حالة الجلسة: معلقة، مؤكدة، مكتملة، ملغاة');
            $table->enum('type', ['online', 'in-person'])
                  ->comment('نوع الجلسة: عن بعد أو حضوري');
            $table->text('notes')->nullable()->comment('ملاحظات إضافية');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sessions_doc');
    }
};
