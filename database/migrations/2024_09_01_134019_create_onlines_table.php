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
        Schema::create('onlines', function (Blueprint $table) {
            $table->id();
            $table->foreignId('resto_id')->constrained();
            $table->timestamp('time_offline');
            $table->timestamp('time_online');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('onlines');
    }
};
