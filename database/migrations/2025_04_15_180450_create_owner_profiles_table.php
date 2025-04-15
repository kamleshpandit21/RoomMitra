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
        Schema::create('owner_profiles', function (Blueprint $table) {
            $table->id('profile_id');

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
        
            $table->string('avatar')->nullable();
        
            $table->string('aadhar', 12)->unique()->nullable();
        
            $table->string('current_address')->nullable();
            $table->string('permanent_address')->nullable();
            $table->string('country', 100)->nullable();
            $table->string('locality', 100)->nullable();
            $table->string('city', 100)->nullable();
            $table->string('state', 100)->nullable();
            $table->string('pincode', 10)->nullable();
        
            $table->date('dob')->nullable(); 
        
            $table->enum('gender', ['Male', 'Female', 'Other'])->nullable();
        
            $table->json('social_links')->nullable();
        
            $table->string('bank_account')->nullable();
            $table->string('ifsc_code')->nullable();
        
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('owner_profiles');
    }
};
