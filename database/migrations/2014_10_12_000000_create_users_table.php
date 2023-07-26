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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->integer('points')->comment('Бонусные баллы')->default(0);
            $table->smallInteger('connection_type')->nullable()->comment('Тип связи');
            $table->string('surname')->nullable();
            $table->string('phone', 20)->nullable();
            $table->date('birthday')->nullable();
            $table->boolean('is_subscribed')->default(false)->comment('Подписан на рассылку');
            $table->bigInteger('role_id')->default(2)->after('id')->comment('Role id');
            $table->boolean('is_active')->default(true);
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
