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
            $table->id()->startingValue(1000);
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null')->onUpdate('set null');
            $table->foreignId('coupon_id')->nullable()->constrained()->onDelete('set null')->onUpdate('set null');
            $table->foreignId('order_status_id')->nullable()->constrained()->onDelete('set null')->onUpdate('set null');
            $table->foreignId('city_id')->nullable()->constrained()->onDelete('set null')->onUpdate('set null');
            $table->decimal('sub_total')->nullable();
            $table->decimal('tax')->nullable();
            $table->decimal('shipping')->nullable();
            $table->decimal('discount')->nullable();
            $table->decimal('total')->nullable();
            $table->integer('payment_method')->nullable()->comment('0 => online payment method, 1 => bank transfer method');
            $table->integer('payment_status')->nullable()->comment('0 => pending, 1 => paid, 2 => failed, 3 => Refunded');
            $table->string('transaction_id')->nullable();
            $table->string('transaction_image')->nullable();
            $table->string('lat')->nullable();
            $table->string('lng')->nullable();
            $table->text('address')->nullable();
            $table->text('note')->nullable();
            $table->timestamps();
            $table->boolean('client_received_refund')->default(0);
            $table->boolean('client_want_to_cancle')->default(0);
            $table->boolean('admin_approve_to_cancle')->default(0);
            $table->boolean('is_new')->default(1);
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
