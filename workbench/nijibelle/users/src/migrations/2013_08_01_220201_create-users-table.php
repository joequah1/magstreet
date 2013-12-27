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
		if(!Schema::hasTable('users'))
		{
			Schema::create('users', function($table){
			   $value = 1;

			$table->increments('id');
			$table->string('firstname', 20);
			$table->string('lastname', 20);
			$table->string('email', 100)->unique();
            $table->string('username',20)->unique();
			$table->string('password', 64);
			$table->string('gender', 1);
			$table->date('dob');
			$table->boolean('status')->default($value);
			$table->timestamps();
			$table->softDeletes();

			});

			DB::table('users')->insert(
				array(
					"firstname" => "admin",
					"lastname" => "user",
					"email" => "admin@admin.com",
                    "username" => "admin",
					"password" => \Hash::make("password"),
					"gender" => "m",
					"dob" => "2013-12-12",
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
		Schema::drop('users');
	}

}
