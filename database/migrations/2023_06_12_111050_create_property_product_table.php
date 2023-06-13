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
        Schema::create('property_product', function (Blueprint $table) {
            $table->id();
            $table->foreignId('property_category_id')->constrained('property_category');
            $table->foreignId('product_id');
            $table->foreignId('property_value_id')->constrained('property_value');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('property_product');
    }
};
