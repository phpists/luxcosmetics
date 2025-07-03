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
        Schema::create('home_main_slider', function (Blueprint $table) {
            $table->id();
            $table->string('file')->comment('Фото/Відео');
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->string('btn_title')->nullable();
            $table->string('link')->nullable();
            $table->boolean('status')->default(1);
            $table->bigInteger('pos')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('home_main_slider');
    }
};
