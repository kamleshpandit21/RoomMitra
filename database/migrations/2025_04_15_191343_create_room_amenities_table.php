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
        Schema::create('room_amenities', function (Blueprint $table) {
                $table->id(); 
                
                $table->unsignedBigInteger('room_id');
                $table->foreign('room_id')->references('room_id')->on('rooms')->onDelete('cascade');
            
                // Amenity Details
                $table->string('amenity_name'); // e.g. 'WiFi', 'Laundry'
                $table->enum('status', ['free', 'paid'])->default('free');
                $table->decimal('price', 10, 2)->nullable()->comment('Applicable if paid');
            
                $table->timestamps();
            
                 });
            
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('room_amenities');
    }
};
