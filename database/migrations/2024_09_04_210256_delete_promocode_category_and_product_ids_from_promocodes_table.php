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
        Schema::table('promo_codes', function (Blueprint $table) {
            $table->dropColumn(['category_id', 'product_id']);
            $table->enum('type', array_keys(\App\Models\PromoCode::ALL_TYPES))->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('promo_codes', function (Blueprint $table) {
            $table->foreignIdFor(\App\Models\Category::class)->nullable();
            $table->foreignIdFor(\App\Models\Product::class)->nullable();
        });
    }
};
