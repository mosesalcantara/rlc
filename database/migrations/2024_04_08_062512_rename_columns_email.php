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
        Schema::table('inquiry_emails', function (Blueprint $table) {
            $table->renameColumn('fullname', 'name');
            $table->renameColumn('contact_number', 'phone');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('inquiry_emails', function (Blueprint $table) {
            $table->renameColumn('name', 'fullname');
            $table->renameColumn('phone', 'contact_number');
        });
    }
};
