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
        Schema::table('gift_products', function (Blueprint $table) {
            $table->dropColumn('is_available');
            $table->integer('pieces')->default(0);
            $table->string('img')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('gift_products', function (Blueprint $table) {
            $table->dropColumn('pieces');
            $table->boolean('is_available')->default(0);
            $table->string('img')->change();
        });
    }
};
