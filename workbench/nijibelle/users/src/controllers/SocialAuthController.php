<?php namespace Nijibelle\Users;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Config;
use Illuminate\Routing\Controllers\Controller;

use Nijibelle\Users\User;

class SocialAuthController extends \BaseController {

	/**
	* View Layout
	*
	* @return
	*/
	protected $layout = 'users::layout.main';

	public function __construct() 
	{	
		if(Config::get('users::layout.set'))
		{
			$this->layout = Config::get('users::layout.name');
		}
	}

	/**
	* Facebook Login
	*
	* @return
	*/
	public function getFacebook()
	{
		$fb_user = \Social::facebook('/me');

		$input = array('email'=>"$fb_user->email");

		$validator = Validator::make($input, User::$rules_fb);

		if($validator->passes())
		{
			$dob = date("Y-m-d",strtotime($fb_user->birthday));

			$this->showRegister($fb_user->first_name, $fb_user->last_name, $fb_user->email, $fb_user->gender, $dob);
		    
		}else
		{   
			$this->showLogin($fb_user->email);
		}
	}

	public function showRegister($firstname, $lastname, $email, $gender, $dob = null)
	{
		$input = array(
			'firstname'=>"$fb_user->first_name",
			'lastname'=>"$fb_user->last_name",
			'email'=>"$fb_user->email",
			'gender'=>"$fb_user->gender",
			'dob'=>"$dob"
		);

		$this->layout->content = \View::make('users::social.socialRegister', $input);	
	}

	public function showLogin($email)
	{
		$input = array(
			'email'=>$email
		);

		$this->layout->content = \View::make('users::social.socialLogin', $input);
	}

	/**
	* Social Login
	*
	* @return
	*/
	public function postSocialLogin()
	{
		$email = Input::get('email');
		
		$user = User::where('email','=',"$email")->first();           
		\Auth::login($user);
		
		return Redirect::to(Config::get('users::route').'/dashboard')->with('message', "$email");
	}
}
