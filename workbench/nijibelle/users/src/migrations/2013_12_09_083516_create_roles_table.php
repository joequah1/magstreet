<?php

use Illuminate\Database\Migrations\Migration;

class CreateRolesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		if(!Schema::hasTable('roles'))
		{
			Schema::create('roles', function($table){
				$value = 1;

				$table->increments('id');
				$table->string('name', 20);
				$table->string('description',50);
				$table->integer('created_by')->unsigned();
				$table->softDeletes();
				$table->timestamps();
				$table->foreign('created_by')->references('id')->on('users');
			});

			DB::table('roles')->insert(
				array(
					"name" => "admin",
					"description" => "Admin User",
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
		Schema::drop('roles');
	}

}
