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
        Schema::create('admins', function (Blueprint $table) {
            $table->id('admin_id');
    
            // Basic Information
            $table->string('username')->unique()->nullable(false);
            $table->string('full_name', 50)->nullable(false);
            $table->string('email', 100)->unique()->nullable(false); 
            $table->string('phone', 15)->nullable()->unique(); 
            
            // Password
            $table->string('password')->nullable(false);
            $table->timestamps();    
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admins');
    }
};
