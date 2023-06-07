<?php

use App\Enums\AvailableOptions;
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
        Schema::table('product_variations', function (Blueprint $table) {
            $table->smallInteger('availability')
                ->default(AvailableOptions::AVAILABLE->value)
                ->comment('Доступність товару');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
    }
};
