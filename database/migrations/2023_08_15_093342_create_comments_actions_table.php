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
        Schema::create('comments_actions', function (Blueprint $table) {
            $table->integer('user_id');
            $table->boolean('like');
            $table->integer('report_id')->comment('Питання або коментар');
            $table->string('table_name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments_actions');
    }
};
