<?php

use Illuminate\Database\Migrations\Migration;

class CreateUserRolesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		if(!Schema::hasTable('user_roles'))
		{
			Schema::create('user_roles', function($table){
				$value = 1;

				$table->integer('user_id')->unsigned();
				$table->integer('role_id')->unsigned();
				$table->primary(array('user_id','role_id'));
				$table->foreign('user_id')->references('id')->on('users');
				$table->foreign('role_id')->references('id')->on('roles');
			});

			DB::table('user_roles')->insert(
				array(
					"user_id" => "1",
					"role_id" => "1",
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
		//
	}

}
