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
        Schema::create('gift_condition_exceptions', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\GiftCondition::class);
            $table->string('type');
            $table->foreignId('foreign_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gift_condition_exceptions');
    }
};
