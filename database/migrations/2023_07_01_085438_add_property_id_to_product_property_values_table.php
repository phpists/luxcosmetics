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
        Schema::table('product_property_values', function (Blueprint $table) {
            $table->foreignIdFor(\App\Models\Property::class)->after('product_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('product_property_values', function (Blueprint $table) {
            $table->dropColumn('property_id');
        });
    }
};
