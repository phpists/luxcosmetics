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
        Schema::table('categories', function (Blueprint $table) {
            $table->text('description_meta')->nullable()->change();
            $table->text('keywords_meta')->nullable()->change();
            $table->text('og_title_meta')->nullable()->change();
            $table->text('og_description_meta')->nullable()->change();
            $table->text('title_meta')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->text('description_meta')->comment('Для seo')->change();
            $table->text('keywords_meta')->comment('Для seo')->change();
            $table->text('og_title_meta')->comment('Для микро seo')->change();
            $table->text('og_description_meta')->comment('Для микро seo')->change();
            $table->text('title_meta')->change();
        });
    }
};
