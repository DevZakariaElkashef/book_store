<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null')->onUpdate('set null');
            $table->foreignId('coupon_id')->nullable()->constrained()->onDelete('set null')->onUpdate('set null');
            $table->foreignId('order_status_id')->nullable()->constrained()->onDelete('set null')->onUpdate('set null');
            $table->string('shipping')->nullable();
            $table->string('sub_total')->nullable();
            $table->string('total')->nullable();
            $table->integer('payment_method')->nullable()->comment('0 => online payment method, 1 => bank transfer method');
            $table->integer('payment_status')->nullable()->comment('0 => pending, 1 => paid, 2 => failed, 3 => Refunded');
            $table->string('transaction_id')->nullable();
            $table->timestamps();
            $table->boolean('is_active')->default(1);
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
