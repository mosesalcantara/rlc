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
        Schema::table('sale_units', function (Blueprint $table) {
            $table->double('area', 10, 2)->after('type');
            $table->double('price', 10, 2)->after('area');
            $table->string('status')->after('price');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sale_units', function (Blueprint $table) {
            $table->dropColumn(['area', 'price', 'status']);
        });
    }
};
