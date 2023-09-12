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
        Schema::create('gift_conditions', function (Blueprint $table) {
            $table->id();
            $table->enum('type', array_keys(\App\Models\GiftCondition::ALL_TYPES));
            $table->integer('min_sum')->nullable();
            $table->integer('max_sum')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gift_conditions');
    }
};
