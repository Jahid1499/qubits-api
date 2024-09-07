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
        Schema::create('purchase_skds', function (Blueprint $table) {
            $table->id();
            $table->integer('quantity');
            $table->float('price', 8, 4);
            $table->float('weight', 8, 2);
            $table->unsignedBigInteger('skd_id');
            $table->unsignedBigInteger('purchase_order_id');
            $table->foreign('skd_id')->references('id')->on('skds')->onDelete('cascade');
            $table->foreign('purchase_order_id')->references('id')->on('purchase_orders')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_skds');
    }
};
