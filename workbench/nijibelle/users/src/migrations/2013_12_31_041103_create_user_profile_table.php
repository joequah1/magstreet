<?php

use Illuminate\Database\Migrations\Migration;

class CreateUserProfileTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		if(!Schema::hasTable('user_profile'))
		{
			Schema::create('user_profile', function($table){
		
				$table->increments('id');
                $table->string('description', 255);
                $table->integer('created_by')->unsigned();
				$table->foreign('created_by')->references('id')->on('users');
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
		Schema::drop('user_profile');
	}

}