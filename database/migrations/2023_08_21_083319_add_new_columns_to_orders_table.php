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
            $table->decimal('discount')->nullable();
            $table->foreignIdFor(\App\Models\GiftCard::class)->nullable();
            $table->foreignIdFor(\App\Models\PromoCode::class)->nullable();
            $table->boolean('is_used_bonuses')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn([
                'discount',
                'gift_card_id',
                'promo_code_id',
                'is_used_bonuses',
            ]);
        });
    }
};
