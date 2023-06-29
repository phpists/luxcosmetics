<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSocialMediasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('social_medias', function (Blueprint $table) {
            $table->id();
            $table->integer('type_id')->nullable();
            $table->integer('pos')->nullable();
            $table->string('icon')->nullable();
            $table->string('phone')->nullable()->comment('Номер телефону');
            $table->string('link')->nullable();
            $table->boolean('is_active_in_contacts')->nullable();
            $table->boolean('is_active_in_footer')->nullable();
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
        Schema::dropIfExists('social_medias');
    }
}
