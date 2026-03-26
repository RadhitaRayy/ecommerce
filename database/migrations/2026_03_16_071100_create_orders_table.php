<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_address_id')->nullable()->constrained()->nullOnDelete();
            $table->string('invoice_num')->unique();
            $table->string('courier')->nullable(); // JNE, TIKI, POS
            $table->string('courier_service')->nullable(); // REG, YES, OKE
            $table->string('tracking_number')->nullable();
            $table->unsignedBigInteger('subtotal')->default(0);
            $table->unsignedBigInteger('shipping_cost')->default(0);
            $table->unsignedBigInteger('grand_total')->default(0);
            $table->enum('status', ['pending', 'paid', 'processing', 'shipping', 'done', 'cancelled'])->default('pending');
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
