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
            $table->float('old_price')->nullable();			
            $table->integer('image_print_id')->nullable()->comment('ГЛАВНОЕ ИЗОБРАЖЕНИЕ');
            $table->float('discount_price')->nullable()->comment('Ціна зі знижкою');
            $table->integer('category_id')->comment('Головна категорія');
            $table->integer('brand_id')->comment('Бренд');
            $table->text('description_1')->comment('Опис 1');
            $table->text('description_2')->nullable()->comment('Опис 2');
            $table->text('description_3')->nullable()->comment('Опис 3');
            $table->foreignIdFor(\App\Models\Property::class, 'base_property_id');

            $table->integer('availability')->default(AvailableOptions::AVAILABLE->value)->comment('Доступність товару');
            $table->integer('points')->comment('Бонусные баллы')->default(0);

            $table->boolean('show_in_sales_page')->default(false)->comment('Отобразить на странице Акции');
            $table->boolean('show_in_percent_discount_page')->default(false)->comment('Отобразить на странице До -50% скидки');
            $table->boolean('show_in_new_page')->default(false)->comment('Отобразить на странице Новинки');
            $table->boolean('show_in_popular')->default(false);			
			
            $table->string('size');



            $table->integer('discount_price')->nullable()->change();
            //$table->renameColumn('discount_price', 'discount');

            $table->text('description_meta')->comment('Для seo');
            $table->text('keywords_meta')->comment('Для seo');
            $table->text('og_title_meta')->comment('Для микро seo');

            $table->text('og_description_meta')->comment('Для микро seo');
            $table->integer('height_product')->nullable()->comment('Высота');
            $table->integer('width_product')->nullable()->comment('Ширина');
            $table->integer('length_product')->nullable()->comment('Длина');
            $table->integer('weight_product')->nullable()->comment('Вес');
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
