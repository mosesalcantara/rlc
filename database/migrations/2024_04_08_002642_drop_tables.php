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
        Schema::dropIfExists('sale_units');
        Schema::dropIfExists('sale_snapshots');
        Schema::dropIfExists('sale_unit_videos');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
