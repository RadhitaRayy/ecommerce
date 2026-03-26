<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->cascadeOnDelete();
            $table->string('snap_token')->nullable();
            $table->string('payment_method')->nullable(); // qris, bank_transfer, gopay, dll
            $table->string('payment_type')->nullable(); // bank name jika VA
            $table->unsignedBigInteger('amount');
            $table->enum('status', ['pending', 'settlement', 'expire', 'cancel', 'deny', 'refund'])->default('pending');
            $table->string('transaction_id')->nullable(); // Midtrans transaction ID
            $table->json('midtrans_response')->nullable(); // raw response dari Midtrans
            $table->timestamp('paid_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
