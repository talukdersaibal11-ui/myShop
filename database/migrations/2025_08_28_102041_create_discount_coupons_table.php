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
        Schema::create('discount_coupons', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->enum('type',['percentage','fixed']);
            $table->decimal('value',10,2);
            $table->decimal('min_order_amount',10,2)->default(0);
            $table->decimal('max_discount',10,2)->nullable();
            $table->integer('usage_limit')->default(1);
            $table->enum('status',['active','expired','inactive'])->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('discount_coupons');
    }
};
