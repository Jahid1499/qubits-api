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
        Schema::create('product_skd_configurations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_configuration_id');
            $table->unsignedBigInteger('skd_id');

            $table->foreign('product_configuration_id')->references('id')->on('product_configrations')->onDelete('cascade');
            $table->foreign('skd_id')->references('id')->on('skds')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_skd_configurations');
    }
};
