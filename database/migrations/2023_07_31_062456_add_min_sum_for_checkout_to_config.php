<?php

use App\Services\SiteConfigService;
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
        Schema::table('config', function (Blueprint $table) {
            SiteConfigService::setParam('min_checkout_sum', 100, SiteConfigService::NUMERIC);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('config', function (Blueprint $table) {
            //
        });
    }
};
