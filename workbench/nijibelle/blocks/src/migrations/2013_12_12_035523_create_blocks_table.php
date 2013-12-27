<?php

use Illuminate\Database\Migrations\Migration;

class CreateBlocksTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		if(!Schema::hasTable('blocks'))
		{
			Schema::create('blocks', function($table){
				$value = 1;

				$table->increments('id');
				$table->text('caption');
				$table->integer('created_by')->unsigned();
				$table->integer('image_id')->unsigned();
                $table->integer('category_id')->unsigned();
				$table->boolean('status')->default($value);
				$table->timestamps();

				$table->softDeletes();
				$table->foreign('image_id')->references('id')->on('images');
				$table->foreign('created_by')->references('id')->on('users');
				$table->foreign('category_id')->references('id')->on('categories');
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
		Schema::drop('blocks');
	}

}
