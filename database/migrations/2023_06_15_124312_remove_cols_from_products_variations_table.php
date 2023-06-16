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
        Schema::table('product_variations', function (Blueprint $table) {
            $table->dropForeign('product_variations_product_id_foreign');
            $table->dropColumn('product_id');
            $table->dropColumn('size');
            $table->dropColumn('price');
            $table->dropColumn('discount_price');
            $table->dropColumn('availability');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('product_variations', function (Blueprint $table) {
            $table->foreignId('product_id')->constrained();
            $table->dropColumn('variation_id');
            $table->string('size')->comment("Об'єм");
            $table->float('price')->comment('Ціна');
            $table->float('discount_price')->nullable()->comment('Ціна зі знижкою');
            $table->smallInteger('availability');
        });
    }
};
