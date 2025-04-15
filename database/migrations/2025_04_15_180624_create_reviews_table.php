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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id('review_id');

            $table->unsignedBigInteger('booking_id');
            $table->unsignedBigInteger('user_id')->nullable(); 
            $table->unsignedBigInteger('room_id');

            $table->unsignedTinyInteger('rating'); 
        
            $table->text('review_text');
            
            $table->timestamps();
        
            $table->foreign('booking_id')->references('booking_id')->on('bookings')->onDelete('cascade');
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('set null');
            $table->foreign('room_id')->references('room_id')->on('rooms')->onDelete('cascade');
        
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
