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
            $table->string('key', 40)->comment('Клач');
            $table->string('alias')->default('Аліас');
            $table->bigInteger('position')->comment('Позиція');
            $table->boolean('status')->default(0)->comment('Статус');
            $table->string('image', 300)->nullable();
            $table->boolean('add_to_top_menu')->default(0);
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
