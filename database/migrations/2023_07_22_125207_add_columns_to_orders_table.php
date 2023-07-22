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
            $table->string('full_name')->nullable();
            $table->string('phone')->nullable();
            $table->string('city')->nullable();
            $table->string('region')->nullable();
            $table->string('address')->nullable();

            $table->dropColumn('address_id');

            $table->foreignId('card_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['full_name', 'phone', 'city', 'region', 'address']);
        });
    }
};
