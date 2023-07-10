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
            $table->boolean('show_in_sales_page')->default(false)
                ->comment('Отобразить на странице Акции');
            $table->boolean('show_in_percent_discount_page')->default(false)
                ->comment('Отобразить на странице До -50% скидки');
            $table->boolean('show_in_new_page')->default(false)
                ->comment('Отобразить на странице Новинки');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('show_in_sales_page');
            $table->dropColumn('show_in_percent_discount_page');
            $table->dropColumn('show_in_new_page');
        });
    }
};
