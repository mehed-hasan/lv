<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wallpapers', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('wallpaper_name');
            $table->string('wallpaper_cat');
            $table->string('wallpaper_type');
            $table->string('wallpaper_subscription');
            $table->string('wallpaper_thumb');
            $table->string('wallpaper_image');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wallpapers');
    }
};
