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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('category_id')->nullable()->comment('Родительская категория');
            $table->string('alias')->unique()->comment('Аліас');
            $table->string('name')->comment('Назва');
            $table->string('image')->nullable()->comment('Изображение категории');
            $table->bigInteger('position')->comment('Позиция');
            $table->boolean('status')->default(0)->comment('Статус');
            $table->boolean('add_to_top_menu')->default(0);
            $table->text('description_meta')->comment('Для seo');
            $table->text('keywords_meta')->comment('Для seo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
