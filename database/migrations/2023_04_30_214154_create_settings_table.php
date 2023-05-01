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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('logo')->default('default/image.png');
            $table->string('favicon')->default('default/image.png');
            $table->string('photo_slider_1')->default('default/image.png');
            $table->string('photo_slider_2')->default('default/image.png');
            $table->string('photo_slider_3')->default('default/image.png');
            $table->string('title_slider_1');
            $table->string('title_slider_2');
            $table->string('title_slider_3');
            $table->string('desc_slider_1');
            $table->string('desc_slider_2');
            $table->string('desc_slider_3');
            $table->string('advertisement_1')->default('default/image.png');
            $table->string('advertisement_2')->default('default/image.png');
            $table->string('advertisement_3')->default('default/image.png');
            $table->string('photo_cta')->default('default/image.png');
            $table->string('title_cta');
            $table->string('desc_cta');
            $table->string('about_footer');
            $table->string('facebook')->nullable();
            $table->string('instagram')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
};
