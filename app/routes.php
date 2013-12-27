<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

//Route::controller('/user','UserController');


Route::get('/', function()
{
    if(Users::adminAccess())
        return "ok";
    else
        return "no";
	//return View::make('hello');
});

