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
        Schema::dropIfExists('orders');
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('status_id')->default(\App\Models\Order::STATUS_NEW);
            $table->foreignIdFor(\App\Models\User::class);
            $table->foreignId('address_id');
            $table->foreignId('card_id');
            $table->decimal('total_sum');
            $table->string('delivery_type');
            $table->boolean('gift_box');
            $table->boolean('as_delivery_address');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
