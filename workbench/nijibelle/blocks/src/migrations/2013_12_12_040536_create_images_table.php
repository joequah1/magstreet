<?php

use Illuminate\Database\Migrations\Migration;

class CreateImagesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		if(!Schema::hasTable('images'))
		{
			Schema::create('images', function($table){
				$value = 1;

				$table->increments('id');
				$table->string('path',255);
				$table->integer('created_by')->unsigned();
				$table->boolean('status')->default($value);
				$table->timestamps();

				$table->softDeletes();
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
		Schema::drop('images');
	}

}
