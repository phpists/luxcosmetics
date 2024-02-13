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
        Schema::create('delivery_points', function (Blueprint $table) {
            $table->id();
            $table->string('lms')->nullable();
            $table->string('pointId')->nullable();
            $table->string('pointCode')->nullable();
            $table->string('name')->nullable();
            $table->string('tariffZone')->nullable();
            $table->string('countryCode')->nullable();
            $table->string('countryName')->nullable();
            $table->string('regionName')->nullable();
            $table->string('areaName')->nullable();
            $table->string('cityCode')->nullable();
            $table->string('cityName')->nullable();
            $table->string('zipCode')->nullable();
            $table->string('shortAddress')->nullable();
            $table->string('fullAddress')->nullable();
            $table->string('metroStation')->nullable();
            $table->string('gpsCoordinates')->nullable();
            $table->string('phoneNumber')->nullable();
            $table->string('maxWeight')->nullable();
            $table->string('maxSize')->nullable();
            $table->string('maxVolume')->nullable();
            $table->string('maxAmount')->nullable();
            $table->string('cardPayment')->nullable();
            $table->string('cashPayment')->nullable();
            $table->string('acceptReturns')->nullable();
            $table->string('openingHoursText')->nullable();
            $table->text('additionalDescription')->nullable();
            $table->string('multiBox')->nullable();
            $table->string('openingHours')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('delivery_points');
    }
};
