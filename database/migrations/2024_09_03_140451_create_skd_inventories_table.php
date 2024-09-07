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
        Schema::create('skd_inventories', function (Blueprint $table) {
            $table->id();
            $table->timestamp('insert_date')->nullable();
            $table->foreignId('confirmer')->nullable()->constrained('users')->cascadeOnDelete();
            $table->foreignId('shipment_skd_id')->constrained('shipment_skds')->cascadeOnDelete();
            $table->foreignId('skd_id')->constrained('skds')->cascadeOnDelete();
            $table->enum('status', ['blocked', 'damage', 'active'])->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('skd_inventories');
    }
};
