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
        Schema::table('users', function (Blueprint $table) {
            $table->string('surname')->nullable();
            $table->string('phone', 20)->nullable();
            $table->date('birthday')->nullable();
            $table->boolean('is_subscribed')->default(false)->comment('Подписан на рассылку');
        });
    }
};
