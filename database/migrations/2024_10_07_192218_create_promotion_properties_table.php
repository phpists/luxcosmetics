<?php

use App\Models\Promotion;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('promotion_properties', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Promotion::class)->constrained()->cascadeOnDelete();
            $table->string('title');
            $table->string('value');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('promotion_properties');
    }
};
