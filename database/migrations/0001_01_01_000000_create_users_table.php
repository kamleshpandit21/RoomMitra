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
        Schema::create('users', function (Blueprint $table) {
            $table->id('user_id');
            $table->string('full_name')->nullable(false);
            $table->string('email')->unique()->nullable(false);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable(false);
            $table->string('phone')->nullable()->unique(); 
            $table->enum('role', ['user', 'room_owner'])->default('user');
            $table->boolean('is_verified')->default(false);
            $table->boolean('is_blocked')->default(false);
            $table->string('provider')->nullable()->comment('Google, Facebook, etc.');
            $table->string('provider_id')->nullable();
            $table->string('remember_token')->nullable();
            $table->boolean('profile_completed')->default(false);
            $table->index('email');
            $table->timestamps();
            $table->softDeletes();
        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
