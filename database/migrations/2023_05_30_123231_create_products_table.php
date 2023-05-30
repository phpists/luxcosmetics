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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('key', 40)->comment('Ключ');
            $table->boolean('status')->default(1)->comment('Статус');
            $table->float('price')->comment('Ціна');
            $table->bigInteger('category_id')->comment('Категорія');
            $table->bigInteger('image_print_id')->nullable()->comment('Головне зображення');
            $table->bigInteger('position')->nullable()->comment('Позиція');
            $table->string('alias')->comment('Аліас');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
