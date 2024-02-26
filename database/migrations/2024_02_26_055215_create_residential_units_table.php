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
        Schema::create('residential_units', function (Blueprint $table) {
            $table->id();
            $table->string('unit_id');
            $table->string('building');
            $table->string('type');
            $table->double('area', 10, 2);
            $table->double('rate', 10, 2);
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('residential_units');
    }
};
