<?php

use Illuminate\Database\Migrations\Migration;

class CreateProfileImageTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		if(!Schema::hasTable('profile_image'))
		{
			Schema::create('profile_image', function($table){
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
		Schema::drop('profile_image');
	}

}
