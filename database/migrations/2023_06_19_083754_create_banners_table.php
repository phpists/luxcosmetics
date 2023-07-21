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
        Schema::create('banners', function (Blueprint $table) {
            $table->id();
            $table->string('image');
            $table->string('title');
            $table->mediumText('text');
            $table->string('link');
            $table->smallInteger('status');
            $table->enum('position', ['first', 'second', 'third', 'fourth', 'fifth']);
            $table->integer('number_position')->nullable();
            $table->dateTime('published_at');
            $table->text('description_meta')->comment('Для seo');
            $table->text('keywords_meta')->comment('Для seo');
            $table->text('og_description_meta')->comment('Для микро seo');
            $table->text('og_title_meta')->comment('Для микро seo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('banners');
    }
};
