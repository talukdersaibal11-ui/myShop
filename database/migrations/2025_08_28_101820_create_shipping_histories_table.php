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
        Schema::create('shipping_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->onDelete('cascade');
            $table->foreignId('shipped_by')->nullable()->constrained('users')->onDelete('set null');
            $table->string('courier_name')->nullable();
            $table->string('tracking_number')->nullable();
            $table->enum('status',['pending','shipped','in_transit','delivered','returned'])->default('pending');
            $table->string('location')->nullable();
            $table->text('note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shipping_histories');
    }
};
