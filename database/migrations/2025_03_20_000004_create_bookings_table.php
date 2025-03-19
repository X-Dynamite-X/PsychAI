<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('specialist_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            // تصحيح اسم الجدول المرجعي
            $table->foreignId('session_doc_id')->constrained('sessions_doc')->onDelete('cascade');
            $table->decimal('amount', 10, 2)->comment('تكلفة الحجز');
            $table->enum('payment_status', ['pending', 'paid', 'refunded'])
                  ->default('pending')
                  ->comment('حالة الدفع');
            $table->string('payment_id')->nullable()->comment('معرف عملية الدفع');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};


