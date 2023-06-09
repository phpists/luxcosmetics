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
        Schema::create('user_addresses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->string('name');
            $table->string('surname');
            $table->string('phone', 20);
            $table->string('email');
            $table->string('city')->comment('Город');
            $table->string('region')->comment('Область');
            $table->string('address')->comment('Адрес');
            $table->boolean('is_default')->comment('Адрес по умолчанию');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_addresses');
    }
};
