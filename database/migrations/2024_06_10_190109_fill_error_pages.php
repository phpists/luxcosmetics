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
        \App\Models\Page::create([
            'title' => '404',
            'link' => '404',
            'content' => '<h1 style="color: red">404! Страница не найдена</h1>',
            'is_active' => 1
        ]);
        \App\Models\Page::create([
            'title' => '403',
            'link' => '403',
            'content' => '<h1 style="color: red">403 Forbidden</h1>',
            'is_active' => 1
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
