<?php

use App\Models\FeedbackMessage;
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
        Schema::create('feedback_message_files', function (Blueprint $table) {
            $table->id();
            $table->foreignId('feedback_message_id')->constrained()->references('id')->on('feedback_message')->cascadeOnDelete();
            $table->string('disk');
            $table->string('name');
            $table->string('path');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('feedback_message_files');
    }
};
