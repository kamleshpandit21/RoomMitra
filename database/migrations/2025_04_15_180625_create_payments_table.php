<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
                $table->id('payment_id');
                
                // Foreign keys
                $table->unsignedBigInteger('booking_id');
                $table->unsignedBigInteger('user_id');
                
                // Payment details
                $table->decimal('amount', 10, 2);  // Amount paid
                
                $table->enum('payment_method', ['UPI', 'Credit Card', 'Debit Card', 'Net Banking'])->nullable(false);
                $table->string('transaction_id')->unique()->nullable(false);  // Transaction ID from payment gateway
                $table->enum('status', ['success', 'failed', 'pending'])->default('pending'); // Payment status
                
                // Date & time
                $table->timestamp('payment_date')->nullable()->default(DB::raw('CURRENT_TIMESTAMP'));  // Payment date
                
                // Foreign key constraints
                $table->foreign('booking_id')->references('booking_id')->on('bookings')->onDelete('cascade');
                $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
                
                $table->timestamps();  // Automatically include created_at and updated_at
            });
            
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
