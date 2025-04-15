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
        Schema::create('rooms', function (Blueprint $table) {
            $table->id('room_id');

            // Owner (User)
            $table->unsignedBigInteger('owner_id');
            $table->foreign('owner_id')->references('user_id')->on('users')->onDelete('cascade');

            // Basic Info
            $table->string('room_number');
            $table->string('room_title');
            $table->text('room_description')->nullable();

            $table->decimal('room_price', 10, 2);
            $table->integer('security_deposit')->default(0);
            $table->integer('min_stay_months')->default(1);

            // Flexible Pricing for Sharing
            $table->json('sharing_prices'); // e.g. {"single": 7000, "double": 5000}

            // Capacity
            $table->integer('room_capacity');
            $table->integer('total_beds');

            // Specifications
            $table->string('floor')->nullable();
            $table->boolean('ac')->default(false);
            $table->boolean('lift')->default(false);
            $table->boolean('parking')->default(false);
            $table->enum('bathroom_type', ['attached', 'shared']);
            $table->boolean('kitchen')->default(false);
            $table->enum('kitchen_type', ['personal', 'shared'])->nullable();

            // Location
            $table->string('address_line1');
            $table->string('address_line2')->nullable();
            $table->string('locality');
            $table->string('city');
            $table->string('state');
            $table->string('pincode');
            $table->text('nearby_landmarks')->nullable();
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();


            // Restrictions & Timings
            $table->timestamp('entry_time')->nullable();
            $table->timestamp('exit_time')->nullable();
            $table->boolean('check_in')->default(false);
            $table->boolean('check_out')->default(false);
            $table->timestamp('check_in_time')->nullable();
            $table->timestamp('check_out_time')->nullable();
            $table->text('restrictions')->nullable();

            // Status Flags
            $table->boolean('is_verified')->default(true);
            $table->enum('status', ['available', 'booked', 'pending', 'inactive'])->default('available');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
