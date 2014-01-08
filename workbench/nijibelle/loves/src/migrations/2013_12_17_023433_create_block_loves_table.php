<?php

use Illuminate\Database\Migrations\Migration;

class CreateBlockLovesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		if(!Schema::hasTable('block_loves'))
		{
			Schema::create('block_loves', function($table){
				$value = 1;

				$table->integer('user_id')->unsigned();
				$table->integer('block_id')->unsigned();
				$table->primary(array('user_id','block_id'));
				$table->foreign('user_id')->references('id')->on('users');
				$table->foreign('block_id')->references('id')->on('blocks');
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
		Schema::drop('block_loves');
	}

}
