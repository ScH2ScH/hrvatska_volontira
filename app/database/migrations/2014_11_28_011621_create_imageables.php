<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateImageables extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('imageables', function (Blueprint $table) {
            $table->integer('image_id')->unsigned();;
            $table->foreign('image_id')->references('id')->on('images')->onDelete('restrict');

            $table->integer('imageable_id')->unsigned();
            $table->string('imageable_type');
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
        Schema::drop('imageables');
    }

}
