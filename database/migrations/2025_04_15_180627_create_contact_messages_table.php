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
        Schema::create('contact_messages', function (Blueprint $table) {
            $table->id('message_id');
    
            // User's Contact Information
            $table->string('name');
            $table->string('email');
           
            
            // Subject and Message content
            $table->string('subject');
            $table->text('message');
            
            // Status of the message
            $table->enum('status', ['new', 'read', 'responded'])->default('new');
            
            // Timestamps
            $table->timestamps();
        
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contact_messages');
    }
};
