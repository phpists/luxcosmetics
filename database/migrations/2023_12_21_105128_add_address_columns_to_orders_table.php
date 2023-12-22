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
        Schema::table('orders', function (Blueprint $table) {
            $table->string('city');
            $table->string('street');
            $table->string('house');
            $table->string('zip');
            $table->string('apartment')->nullable()->comment('квартира');
            $table->string('intercom')->nullable()->comment('домофон');
            $table->string('entrance')->nullable()->comment('подьезд');
            $table->string('over')->nullable()->comment('етаж');
            $table->string('service')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['city', 'street', 'house', 'zip', 'apartment', 'intercom', 'entrance', 'over', 'service']);
        });
    }
};
