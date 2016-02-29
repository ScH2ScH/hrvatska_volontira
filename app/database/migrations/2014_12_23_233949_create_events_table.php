<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEventsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->text('description');
            $table->integer('estimated_volunteers_no');
            $table->dateTime('start')->nullable();
            $table->dateTime('end')->nullable();
            $table->string('working_hours')->nullable();
            $table->float('total_hours')->nullable();
            $table->string('address')->nullable();
            $table->string('email')->nullable();
            $table->integer('city_id')->unsigned();;
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('restrict');

            $table->string('contact_person');
            $table->string('phone');
            $table->text('additional_note');

            /*
             * Attributes which are not shown on creating new event, just on editing existing one
             * */
            $table->integer('final_estimated_volunteers_no')->nullable();
            $table->float('final_total_hours')->nullable();
            $table->text('final_report')->nullable();



            $table->integer('action_id')->unsigned();;
            $table->foreign('action_id')->references('id')->on('actions')->onDelete('restrict');

            $table->integer('host_id')->unsigned();;
            $table->foreign('host_id')->references('id')->on('hosts')->onDelete('restrict');

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
        Schema::drop('events');
    }

}
