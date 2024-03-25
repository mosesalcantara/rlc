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
        Schema::table('settings', function (Blueprint $table) {
            $table->string('messenger');
            $table->string('messenger_text');
            $table->string('telegram');
            $table->string('telegram_text');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn('messenger');
            $table->dropColumn('messenger_text');
            $table->dropColumn('telegram');
            $table->dropColumn('telegram_text');
        });
    }
};
