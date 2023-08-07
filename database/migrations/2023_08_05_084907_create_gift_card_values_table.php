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
        Schema::create('gift_card_values', function (Blueprint $table) {
            $table->id();
            $table->integer('min_sum')->nullable()->comment('Мінімальна сума для карти');
            $table->integer('max_sum')->nullable()->comment('Максимальна сума для карти');
            $table->integer('fix_price')->nullable()->comment('Фіксована ціна для карт');
            $table->string('color_card')->nullable()->comment('Колір для карти');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gift_card_values');
    }
};
