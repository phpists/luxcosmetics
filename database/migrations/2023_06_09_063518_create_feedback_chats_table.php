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
        Schema::create('feedback_chats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('feedbacks_reason_id')->constrained();
            $table->smallInteger('status')->comment('Статус тикета');
            $table->foreignId('user_id')->constrained();
            $table->string('email');
            $table->string('phone', 20);
            $table->string('order_number');
            $table->string('feedback_theme');
            $table->bigInteger('assignee_id')->nullable()->comment('Id администратора');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('feedback_chats');
    }
};
