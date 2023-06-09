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
        Schema::create('payment_cards', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('full_name');
            $table->string('valid_date')->comment('Срок действия карты');
            $table->string('card_number')->comment('Номер карты');
            $table->string('cvv')->comment('CVV');
            $table->boolean('is_default')->comment('По умолчанию');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_cards');
    }
};
