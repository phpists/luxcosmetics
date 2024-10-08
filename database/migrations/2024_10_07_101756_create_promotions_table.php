<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('promotions', function (Blueprint $table) {
            $table->id();
            $table->boolean('is_active')->default(true);
            $table->string('title');
            $table->string('slug');
            $table->text('short_description');
            $table->longText('content');
            $table->date('starts_at');
            $table->date('ends_at');
            $table->string('bg_img')->nullable();
            $table->string('btn_title')->nullable();
            $table->string('btn_link')->nullable();
            $table->string('preview_img');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('promotions');
    }
};
