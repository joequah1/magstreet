<?php

use Illuminate\Database\Migrations\Migration;

class CreateShareCommentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('share_comments', function($table){
				$value = 1;

				$table->integer('comment_id')->unsigned();
				$table->integer('share_id')->unsigned();
				$table->primary(array('comment_id','share_id'));
				$table->foreign('share_id')->references('id')->on('shares');
				$table->foreign('share_id')->references('id')->on('blocks');
			});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
	}

}