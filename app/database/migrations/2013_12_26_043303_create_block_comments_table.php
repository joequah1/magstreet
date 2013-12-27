<?php

use Illuminate\Database\Migrations\Migration;

class CreateBlockCommentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('block_comments', function($table){
				$value = 1;

				$table->integer('comment_id')->unsigned();
				$table->integer('block_id')->unsigned();
				$table->primary(array('comment_id','block_id'));
				$table->foreign('comment_id')->references('id')->on('comments');
				$table->foreign('block_id')->references('id')->on('blocks');
			});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('block_comments');
	}

}