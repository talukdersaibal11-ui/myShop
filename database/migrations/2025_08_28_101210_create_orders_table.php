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
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('order_number')->unique();
            $table->decimal('total_amount', 10, 2);
            $table->enum('payment_method',['cod','card','bkash','nagad','bank_transfer'])->default('cod');
            $table->text('shipping_address');
            $table->text('billing_address')->nullable();
            $table->decimal('shipping_charge',10,2)->default(0);
            $table->decimal('discount_amount',10,2)->default(0);
            $table->text('notes')->nullable();
            $table->enum('status',['pending','confirmed','processing','shipped','delivered','cancelled','returned'])->default('pending');
            $table->enum('payment_status',['pending','paid','failed','refunded'])->default('pending');

            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();

            $table->softDeletes();
            $table->timestamps();

            // Define Foreign Key
            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('updated_by')->references('id')->on('users');
            $table->foreign('deleted_by')->references('id')->on('users');
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
