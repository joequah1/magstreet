<?php

use Illuminate\Database\Migrations\Migration;

class CreateSharesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		if(!Schema::hasTable('shares'))
		{
			Schema::create('shares', function($table){
				$value = 1;

				$table->increments('id');
				$table->text('caption');
				$table->integer('created_by')->unsigned();
				$table->timestamps();

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
		Schema::drop('shares');
	}

}