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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id('booking_id');

            // User, Room, Owner relation
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('room_id');
            $table->unsignedBigInteger('owner_id');

            // Date fields
            $table->date('check_in_date')->nullable(false); // Made non-nullable
            $table->date('check_out_date')->nullable(); // Made non-nullable

            // Total booking amount
            $table->decimal('total_amount', 10, 2);

            // Booking status & payment status
            $table->enum('status', ['pending', 'confirmed', 'cancelled', 'completed'])->default('pending');
            $table->enum('payment_status', ['pending', 'paid', 'failed'])->default('pending');

            // Optional additional payment details
            $table->string('payment_method')->nullable();
            $table->string('transaction_id')->nullable(); 

            $table->timestamps(); 

            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
            $table->foreign('room_id')->references('room_id')->on('rooms')->onDelete('cascade');
            $table->foreign('owner_id')->references('user_id')->on('users')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
