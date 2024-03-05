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
        Schema::create('about_items', function (Blueprint $table) {
            $table->id();
            $table->string('heading_title');
            $table->string('heading_image');
            $table->text('description');
            $table->string('tagline_title');
            $table->string('tagline');
            $table->string('video_code');
            $table->string('video_title');
            $table->text('video_description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('about_items');
    }
};
