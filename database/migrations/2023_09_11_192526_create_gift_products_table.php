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
        Schema::create('gift_products', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Brand::class);
            $table->string('article')->nullable();
            $table->string('title');
            $table->string('img');
            $table->boolean('is_available')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gift_products');
    }
};
