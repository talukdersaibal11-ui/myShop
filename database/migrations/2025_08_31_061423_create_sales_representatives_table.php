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
        Schema::create('sales_representatives', function (Blueprint $table) {
            $table->id();

            $table->string('employee_code', 50)->unique();
            $table->string('name', 250);
            $table->string('email', 250)->unique()->nullable();
            $table->string('phone_number', 20)->unique();
            $table->string('address', 500)->nullable();
            $table->decimal('initial_balance', 10,2)->nullable();
            $table->enum('type', ['receivable', 'payable'])->default('receivable');
            $table->string('file_path', 250)->nullable();

            // Foreign keys
            $table->string('godown_code');
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();

            $table->softDeletes();
            $table->timestamps();

            // Relationships
            $table->foreign('godown_code')->references('code')->on('godowns');
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
        Schema::dropIfExists('sales_representatives');
    }
};
