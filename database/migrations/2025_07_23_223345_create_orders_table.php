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
            $table->string('order_code')->unique();
            $table->unsignedInteger('employee_id')->nullable();
            $table->string('customer_name')->nullable();
            $table->string('customer_phone', 20)->nullable();
            $table->string('customer_address')->nullable();
            $table->integer('total_quantity')->default(0);
            $table->decimal('total_price', 15, 2)->default(0);
            $table->enum('status', ['pending', 'completed', 'cancelled'])->default('completed');
            $table->boolean('act')->default(1); // hiển thị / không hiển thị
            $table->text('note')->nullable();
            $table->timestamps();

            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('set null');
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
