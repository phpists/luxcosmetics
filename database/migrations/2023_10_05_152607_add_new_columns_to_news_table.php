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
        Schema::table('news_item', function (Blueprint $table) {
            $table->unsignedTinyInteger('slider_type')->default(\App\Models\NewsItem::HORIZONTAL_SLIDER);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

    }
};
