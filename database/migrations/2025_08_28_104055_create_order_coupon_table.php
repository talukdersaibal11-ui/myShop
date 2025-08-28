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
        Schema::create('order_coupon', function (Blueprint $table) {
            $table->id();

            $table->foreignId('order_id')
                  ->constrained('orders')
                  ->onDelete('cascade');

            $table->foreignId('discount_coupon_id')
                  ->constrained('discount_coupons')
                  ->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_coupon');
    }
};
