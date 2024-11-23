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
            $table->boolean('gift_box')->default(false)->change();
            $table->string('city')->nullable()->change();
            $table->string('street')->nullable()->change();
            $table->string('house')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->boolean('gift_box')->change();
            $table->string('city')->change();
            $table->string('street')->change();
            $table->string('house')->change();
        });
    }
};
