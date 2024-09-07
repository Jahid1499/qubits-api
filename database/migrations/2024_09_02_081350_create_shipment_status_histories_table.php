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
        Schema::create('shipment_status_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('shipment_id')->constrained('shipments')->cascadeOnDelete();
            $table->string('status_name');
            $table->float('amount', 8, 2)->nullable();
            $table->timestamp('confirm_or_shipment_date')->nullable();
            $table->timestamp('received_date')->nullable();
            $table->string('c&f')->nullable();
            $table->string('c&f_bills')->nullable();
            $table->string('cost_note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shipment_status_histories');
    }
};
