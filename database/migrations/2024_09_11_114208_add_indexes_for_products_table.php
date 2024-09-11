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
        Schema::table('products', function (Blueprint $table) {
            $table->index('availability');
            $table->foreign('category_id')->references('id')->on('categories');
            $table->foreign('base_property_id')->references('id')->on('properties');
            $table->foreign('brand_id')->references('id')->on('brands');
        });

        Schema::table('product_categories', function (Blueprint $table) {
            $table->foreign('product_id')->references('id')->on('products');
            $table->foreign('category_id')->references('id')->on('categories');
        });

        Schema::table('product_images', function (Blueprint $table) {
            $table->unsignedBigInteger('record_id')->change();
            $table->foreign('record_id')->references('id')->on('products');
        });

        Schema::table('property_value', function (Blueprint $table) {
            $table->unsignedBigInteger('property_id')->change();
            $table->foreign('property_id')->references('id')->on('properties');
        });

        Schema::table('product_property_values', function (Blueprint $table) {
            $table->foreign('product_id')->references('id')->on('products');
            $table->foreign('property_id')->references('id')->on('properties');
            $table->foreign('property_value_id')->references('id')->on('property_value');
        });

        Schema::table('related_products', function (Blueprint $table) {
            $table->foreign('product_id')->references('id')->on('products');
            $table->foreign('relative_product_id')->references('id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropIndex('products_availability_index');
            $table->dropForeign('products_category_id_foreign');
            $table->dropForeign('products_base_property_id_foreign');
            $table->dropForeign('products_brand_id_foreign');
        });

        Schema::table('product_categories', function (Blueprint $table) {
            $table->dropForeign('product_categories_product_id_foreign');
            $table->dropForeign('product_categories_category_id_foreign');
        });

        Schema::table('product_images', function (Blueprint $table) {
            $table->bigInteger('record_id')->change();
            $table->dropForeign('product_images_record_id_foreign');
        });

        Schema::table('property_value', function (Blueprint $table) {
            $table->bigInteger('property_id')->change();
            $table->dropForeign('property_value_property_id_foreign');
        });

        Schema::table('product_property_values', function (Blueprint $table) {
            $table->dropForeign('product_property_values_product_id_foreign');
            $table->dropForeign('product_property_values_property_id_foreign');
            $table->dropForeign('product_property_values_property_value_id_foreign');
        });

        Schema::table('related_products', function (Blueprint $table) {
            $table->dropForeign('related_products_product_id_foreign');
            $table->dropForeign('related_products_relative_product_id_foreign');
        });
    }
};
