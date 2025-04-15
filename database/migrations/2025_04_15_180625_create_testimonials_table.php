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
        Schema::create('testimonials', function (Blueprint $table) {
            $table->id('testimonial_id');
    
            // User or Owner who submitted the testimonial
            $table->unsignedBigInteger('user_id');  // Assuming the user who gave the testimonial
            $table->unsignedBigInteger('room_id')->nullable();  // Optional: If associated with a specific room
        
            // The testimonial content
            $table->text('testimonial');
            
            // Rating for the room/service
            $table->unsignedTinyInteger('rating'); // Rating can range from 1 to 5
            
            $table->enum('status', ['active', 'inactive'])->default('active');
            
            $table->timestamps();
            
            // Foreign key constraints
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
            $table->foreign('room_id')->references('room_id')->on('rooms')->onDelete('set null');
        
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('testimonials');
    }
};
