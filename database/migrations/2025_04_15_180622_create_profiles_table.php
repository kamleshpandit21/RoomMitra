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
        Schema::create('profiles', function (Blueprint $table) {
            $table->id('profile_id');

            $table->unsignedBigInteger('user_id')->index();
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');

            $table->string('avatar')->nullable(); // renamed from avatar
            $table->string('current_address')->nullable();
            $table->string('permanent_address')->nullable();
            $table->string('country', 100)->nullable();
            $table->string('locality', 100)->nullable();
            $table->string('city', 100)->nullable();
            $table->string('state', 100)->nullable();
            $table->string('pincode', 10)->nullable();

            $table->date('date_of_birth')->nullable(); // renamed from dob
            $table->enum('gender', ['Male', 'Female', 'Other'])->nullable();

            $table->string('aadhar', 20)->unique()->nullable();
            $table->string('college_name')->nullable();
            $table->string('course')->nullable();
            $table->integer('study_year')->nullable();
            $table->string('id_card_url')->nullable();

            $table->text('bio')->nullable();
            $table->json('social_links')->nullable();

            $table->timestamps();
            $table->softDeletes(); // optional
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
