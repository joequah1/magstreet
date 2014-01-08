<?php

use Illuminate\Database\Migrations\Migration;

class CreateShareLovesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		if(!Schema::hasTable('share_loves'))
		{
			Schema::create('share_loves', function($table){
				$value = 1;

				$table->integer('user_id')->unsigned();
				$table->integer('share_id')->unsigned();
				$table->primary(array('user_id','share_id'));
				$table->foreign('user_id')->references('id')->on('users');
				$table->foreign('share_id')->references('id')->on('shares');
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
		Schema::drop('share_loves')
	}

}