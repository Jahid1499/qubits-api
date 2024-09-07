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
        Schema::create('shipment_skds', function (Blueprint $table) {
            $table->id();
            $table->float('price', 8, 4);
            $table->integer('required_qty', 8);
            $table->integer('received_qty', 8)->default(0);
            $table->timestamp('received_at')->nullable();
            $table->unsignedBigInteger('skd_id');
            $table->unsignedBigInteger('shipment_id');
            $table->foreign('skd_id')->references('id')->on('skds')->onDelete('cascade');
            $table->foreign('shipment_id')->references('id')->on('shipments')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shipment_skds');
    }
};
