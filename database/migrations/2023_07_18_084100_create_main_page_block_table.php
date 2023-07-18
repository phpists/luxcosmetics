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
        Schema::create('main_page_block', function (Blueprint $table) {
            $table->id();
            $table->string('title')->comment('Тайтл блока');
            $table->text('content')->comment('Текст внутри блока');
            $table->string('video_path')->comment('Путь к видео');
            $table->string('image_path')->comment('Путь к изображению');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('main_page_block');
    }
};
