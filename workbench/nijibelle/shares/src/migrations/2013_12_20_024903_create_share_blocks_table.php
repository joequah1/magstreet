<?php

use Illuminate\Database\Migrations\Migration;

class CreateShareBlocksTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		if(!Schema::hasTable('share_blocks'))
		{
			Schema::create('share_blocks', function($table){
				
				$table->integer('share_id')->unsigned();
				$table->integer('block_id')->unsigned();
				$table->primary(array('share_id','block_id'));
				$table->foreign('share_id')->references('id')->on('shares');
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
		Schema::drop('share_blocks');
	}

}