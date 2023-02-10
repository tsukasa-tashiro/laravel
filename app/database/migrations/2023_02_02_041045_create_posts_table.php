<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id');
            $table->string('title','30');
            $table->string('tag','10');
            $table->string('image1','200');
            $table->string('image2','200')->nullable();
            $table->string('image3','200')->nullable();
            $table->bigInteger('camera_id');
            $table->bigInteger('lens_id');
            $table->string('spot_name','20');
            $table->string('spot_address','100');
            $table->string('longitude','100');
            $table->string('latitude','100');
            $table->bigInteger('report')->default(0);
            $table->bigInteger('del_flg')->default(0);
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
        Schema::dropIfExists('posts');
    }
}
