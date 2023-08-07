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
        Schema::create('gift_cards', function (Blueprint $table) {
            $table->id();
            $table->string('color');
            $table->integer('sum');
            $table->string('receiver')->comment('ПІБ отримувача');
            $table->string('receiver_email')->comment('Пошта отримуача');
            $table->string('from_whom')->nullable()->comment('От кого');
            $table->string('description')->nullable()->comment('Опис');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gift_cards');
    }
};
