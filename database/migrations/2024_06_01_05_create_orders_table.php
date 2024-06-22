<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->char('firstname')->collation('utf8_general_ci');
            $table->char('lastname')->collation('utf8_general_ci');
            $table->enum('order_type', ['inside', 'inout'])->default('inside');
            $table->enum('Reservation_type', ['inside', 'inout'])->default('inside');
            $table->char('description')->nullable()->collation('utf8_general_ci');
            $table->char('phone')->unique();
            $table->dateTime('order_after_time')->nullable();
            $table->dateTime('Reservation_time')->nullable();
            $table->enum('status', ['Canceled', 'doing', 'Completed'])->default('doing');
            $table->unsignedBigInteger('price');
            $table->unsignedBigInteger('discounted_price')->nullable();
            $table->unsignedBigInteger('transport_price')->nullable();
            $table->unsignedBigInteger('total_price');
            $table->timestamps();
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
