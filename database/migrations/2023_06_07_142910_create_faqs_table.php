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
        Schema::create('faqs', function (Blueprint $table) {
            $table->id();
            $table->integer('position');
            $table->string('title');
            $table->text('answer');
            $table->integer('group_id')->comment('Група вопросов');
            $table->boolean('is_active')->comment('Показывать на сайте');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('faqs');
    }
};
