<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Таблиця для значень характеристик
     */
    public function up(): void
    {
        Schema::create('property_value', function (Blueprint $table) {
            $table->id();
            $table->integer('property_id');
            $table->string('value');
            $table->string('color')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('property_value');
    }
};
