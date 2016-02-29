<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateHostsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hosts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();;
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->string('name');
            $table->string('address');
            $table->string('contact_person');
            $table->string('phone');
            $table->string('web');

            $table->integer('organization_type_id')->unsigned();
            $table->foreign('organization_type_id')->references('id')->on('organization_types')->onDelete('restrict');

            $table->text('additional_note')->nullable();
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
        Schema::drop('hosts');
    }

}
