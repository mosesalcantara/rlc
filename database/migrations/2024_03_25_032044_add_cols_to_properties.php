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
        Schema::table('properties', function (Blueprint $table) {
            $table->string('sale_status');
            $table->string('min_price');
            $table->string('max_price');
            $table->string('unit_types');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('properties', function (Blueprint $table) {
            $table->dropColumn('sale_status');
            $table->dropColumn('min_price');
            $table->dropColumn('max_price');
            $table->dropColumn('unit_types');
        });
    }
};
