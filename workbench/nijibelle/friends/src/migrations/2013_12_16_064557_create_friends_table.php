<?php

use Illuminate\Database\Migrations\Migration;

class CreateFriendsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        if(!Schema::hasTable('friends'))
		{
			Schema::create('friends', function($table){
                
                $table->increments('id');
				$table->integer('user_id')->unsigned();
				$table->integer('friend_user_id')->unsigned();
                $table->timestamps();
                $table->softDeletes();
				
				$table->foreign('user_id')->references('id')->on('users');
				$table->foreign('friend_user_id')->references('id')->on('users');
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
		Schema::drop('friends');
	}

}