<?php

use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		if(!Schema::hasTable('comments'))
		{
			Schema::create('comments', function($table){
			    
                $table->increments('id');
                $table->text('message');
                $table->integer('created_by')->unsigned();
				$table->integer('block_id')->unsigned();
                $table->timestamps();
                
                $table->foreign('block_id')->references('id')->on('blocks');
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
		Schema::drop('comments');
	}

}