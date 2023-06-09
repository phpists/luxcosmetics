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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('title')->comment('Назва товару');
            $table->string('alias')->unique()->comment('Аліас');
            $table->string('code', 30)->comment('Код article');
            $table->string('code_1c', 30)->comment('Код article 1C');
            $table->boolean('status')->default(1)->comment('Статус');
            $table->float('price')->comment('Ціна');
            $table->bigInteger('image_print_id')->nullable()->comment('ГЛАВНОЕ ИЗОБРАЖЕНИЕ');
            $table->float('discount_price')->nullable()->comment('Ціна зі знижкою');
            $table->bigInteger('category_id')->comment('Головна категорія');
            $table->integer('brand_id')->comment('Бренд');
            $table->text('description_1')->comment('Опис 1');
            $table->text('description_2')->nullable()->comment('Опис 2');
            $table->text('description_3')->nullable()->comment('Опис 3');
            $table->smallInteger('availability')->default(AvailableOptions::AVAILABLE->value)->comment('Доступність товару');
            $table->integer('points')->comment('Бонусные баллы')->default(0);
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
