<?php

use App\Models\CatalogBanner;
use App\Models\CatalogBannerCondition;
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
        Schema::create('catalog_banner_condition_catalog_banner', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('catalog_banner_condition_id');
            $table->foreign('catalog_banner_condition_id', 'cb_condition_foreign')->references('id')->on('catalog_banner_conditions');
            $table->unsignedBigInteger('catalog_banner_id');
            $table->foreign('catalog_banner_id', 'cb_foreign')->references('id')->on('catalog_banners');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('catalog_banner_condition_catalog_banner');
        Schema::enableForeignKeyConstraints();
    }
};
