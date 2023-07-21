<?php

use App\Enums\AvailableOptions;
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
        Schema::create('product_variations', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('product_id');
            $table->string('size')->comment("Об'єм");
            $table->float('price')->comment('Ціна');
            $table->float('discount_price')->nullable()->comment('Ціна зі знижкою');
            $table->bigInteger('variation_id');
            $table->bigInteger('product_id');
            $table->unique(['product_id', 'variation_id']);
            $table->smallInteger('availability')
                ->default(AvailableOptions::AVAILABLE->value)
                ->comment('Доступність товару');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_variations');
    }
};
