<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewsItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news_item', function (Blueprint $table) {
            $table->id();
            $table->string('image');
            $table->string('title');
            $table->mediumText('text');
            $table->string('link');
            $table->smallInteger('status');
            $table->dateTime('published_at');
            $table->text('description_meta')->comment('Для seo');
            $table->text('keywords_meta')->comment('Для seo');
            $table->text('og_title_meta')->comment('Для микро seo');
            $table->text('og_description_meta')->comment('Для микро seo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('news_item');
    }
}
