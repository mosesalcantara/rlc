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
        Schema::table('parking_slots', function (Blueprint $table) {
            $table->foreignId('floor');
            $table->foreignId('slot');
            $table->foreignId('property_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('parking_slots', function (Blueprint $table) {
            $table->dropColumn('floor');
            $table->dropColumn('slot');
            $table->dropColumn('property_id');
        });
    }
};
