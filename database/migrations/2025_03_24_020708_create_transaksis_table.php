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
            Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('donation_id'); 
            $table->foreign('donation_id')->references('id')->on('donations');
            $table->string('donor_name');
            $table->string('donor_email');
            $table->decimal('amount', 15, 2);
             $table->text('snap_token')->nullable();
            $table->enum('status', ['pending', 'success', 'failed', 'expired', 'challenge'])->default('pending');
            $table->timestamps();
            });
        }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};
