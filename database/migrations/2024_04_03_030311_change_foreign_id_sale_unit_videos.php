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
        Schema::table('sale_unit_videos', function (Blueprint $table) {
            $table->renameColumn('residential_unit_id', 'sale_unit_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sale_unit_videos', function (Blueprint $table) {
            $table->renameColumn('sale_unit_id', 'residential_unit_id');
        });
    }
};
