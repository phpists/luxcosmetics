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
            $table->string('alias')->comment('Аліас');
            $table->string('code', 30)->comment('Код article');
            $table->string('code_1c', 30)->comment('Код article 1C');
            $table->boolean('status')->default(1)->comment('Статус');
            $table->float('price')->comment('Ціна');
            $table->float('discount_price')->nullable()->comment('Ціна зі знижкою');
            $table->foreignId('category_id')->comment('Головна категорія')->constrained('categories');
            $table->foreignId('brand_id')->comment('Бренд')->constrained();
            $table->text('description_1')->comment('Опис 1');
            $table->text('description_2')->nullable()->comment('Опис 2');
            $table->text('description_3')->nullable()->comment('Опис 3');
            $table->smallInteger('availability')->default(AvailableOptions::AVAILABLE->value)->comment('Доступність товару');
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
