<?php

use Illuminate\Database\Migrations\Migration;

class CreateImageLovesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		if(!Schema::hasTable('image_loves'))
		{
			Schema::create('image_loves', function($table){
				$value = 1;

				$table->integer('user_id')->unsigned();
				$table->integer('image_id')->unsigned();
				$table->primary(array('user_id','image_id'));
				$table->foreign('user_id')->references('id')->on('users');
				$table->foreign('image_id')->references('id')->on('images');
			});
		}
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('image_loves');
	}

}