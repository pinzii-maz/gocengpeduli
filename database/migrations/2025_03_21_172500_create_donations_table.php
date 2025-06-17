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
        Schema::create('donations', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable(); 
            $table->text('description')->nullable(); 
            $table->string('category')->nullable(); 
            $table->decimal('target_amount', 15, 2)->default(0);
            $table->date('deadline')->nullable(); 
            $table->string('image')->nullable(); 
            $table->integer('recipient_count')->default(0); 
            $table->decimal('current_amount', 15, 2) ->default(0); 
            $table->integer('donor_count')->default(0);
            $table->timestamps();
        });   
    } 

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donations');
    }
};
