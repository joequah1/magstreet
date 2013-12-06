<?php

use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function($table){
               $value = 1;
            
			$table->increments('id')->unsigned;
			$table->string('firstname', 20);
			$table->string('lastname', 20);
			$table->string('email', 100)->unique();
			$table->string('password', 64);
			$table->string('gender', 1);
			$table->date('dob');
               $table->boolean('status')->default($value);
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
	}

}