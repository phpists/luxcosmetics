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
            $table->dropColumn('discount');
            $table->decimal('gift_card_discount')->nullable();
            $table->decimal('bonuses_discount')->nullable();
            $table->decimal('promo_code_discount')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->decimal('discount')->nullable();
            $table->dropColumn([
                'gift_card_discount',
                'bonuses_discount',
                'promo_code_discount'
            ]);
        });
    }
};
