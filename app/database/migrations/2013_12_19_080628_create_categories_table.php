<?php

use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		if(!Schema::hasTable('categories'))
		{
			Schema::create('categories', function($table){
			 $value = 1;
                
			$table->increments('id');
			$table->string('name', 50);
			$table->integer('parent_id')->unsigned()->default($value);
			$table->integer('created_by')->unsigned();
			$table->timestamps();
			$table->softDeletes();

            $table->foreign('parent_id')->references('id')->on('categories');
            $table->foreign('created_by')->references('id')->on('users');
                
			});

			DB::table('categories')->insert(
				array(
					"name" => "main",
					"created_by" => "1",
				)
			);
		}
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('categories');
	}

}

