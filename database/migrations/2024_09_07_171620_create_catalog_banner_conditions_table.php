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
        Schema::create('catalog_banner_conditions', function (Blueprint $table) {
            $table->id();
            $table->boolean('is_active');
            $table->morphs('model');
            $table->integer('row');
            $table->boolean('share_with_child');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('catalog_banner_conditions');
    }
};
