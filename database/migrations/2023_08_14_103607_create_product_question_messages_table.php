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
        Schema::create('product_question_messages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('question_id')->comment('Id вопроса');
            $table->unsignedBigInteger('user_id')->nullable()->comment('Id пользователя');
            $table->string('username');
            $table->string('email');
            $table->text('message');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_question_messages');
    }
};
