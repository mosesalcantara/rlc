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
            $table->string('wechat');
            $table->string('wechat_text');
            $table->string('viber');
            $table->string('viber_text');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn('wechat');
            $table->dropColumn('wechat_text');
            $table->dropColumn('viber');
            $table->dropColumn('viber_text');
        });
    }
};
