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
        Schema::create('furniture_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('room_id');
            $table->string('item_name');
            $table->string('item_type')->nullable(); // Optional: Material or type
            $table->foreign('room_id')->references('room_id')->on('rooms')->onDelete('cascade');
            $table->timestamps();

            $table->index('room_id');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('furniture_items');
    }
};
