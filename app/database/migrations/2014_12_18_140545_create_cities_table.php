<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCitiesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cities', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string('name');
            $table->string('zip_code');

            $table->integer('county_id')->unsigned();
            $table->foreign('county_id')->references('id')->on('counties')->onDelete('restrict');
            //$table->foreign('county_id')->references('id')->on('counties')->onUpdate('cascade');

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
		Schema::drop('cities');
	}

}
