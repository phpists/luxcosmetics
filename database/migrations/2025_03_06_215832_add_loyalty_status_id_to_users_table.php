<?php

use App\Models\LoyaltyStatus;
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
        Schema::table('users', function (Blueprint $table) {
            $table->foreignIdFor(LoyaltyStatus::class)->default(1);
            $table->integer('custom_loyalty_discount_percent')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeignIdFor(LoyaltyStatus::class);
            $table->dropColumn('custom_loyalty_discount_percent');
        });
    }
};
