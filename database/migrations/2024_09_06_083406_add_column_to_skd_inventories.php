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
        Schema::table('skd_inventories', function (Blueprint $table) {
            $table->integer('quantity')->default(0)->after('skd_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('skd_inventories', function (Blueprint $table) {
            $table->dropColumn('quantity');
        });
    }
};
