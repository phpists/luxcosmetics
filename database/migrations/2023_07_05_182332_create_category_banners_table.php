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
        Schema::create('category_banners', function (Blueprint $table) {
            $table->id();
            $table->integer('pos')->default(999);
            $table->foreignIdFor(\App\Models\Category::class);
            $table->foreignIdFor(\App\Models\Banner::class);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('category_banners');
    }
};
