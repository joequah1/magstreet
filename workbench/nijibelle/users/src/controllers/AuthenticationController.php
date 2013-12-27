<?php namespace Nijibelle\Users;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Config;
use Illuminate\Routing\Controllers\Controller;

use Nijibelle\Users\User;

class AuthenticationController extends \BaseController {

	/**
	* Post login
	*
	* @return
	*/
	public function postLogin()
	{
		if (\Auth::attempt(array('email'=>Input::get('email'), 'password'=>Input::get('password')))) 
		{
			return Redirect::to('u/'.\Auth::user()->username)->with('message', 'You are now logged in!');
		}else 
		{
			return Redirect::to(Config::get('users::route').'/login')
				->with('message', 'Your username/password combination was incorrect')
				->withInput();
		}
	}

    /**
    * Logout function
    *
    */
	public function getLogout()
	{
		\Auth::logout();
        	return Redirect::to(Config::get('users::route').'/login')->with('message', 'Your are now logged out!');
	}
}
