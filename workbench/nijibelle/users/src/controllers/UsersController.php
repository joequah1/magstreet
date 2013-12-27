<?php namespace Nijibelle\Users;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Config;
use Illuminate\Routing\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UsersController extends \BaseController {

	/**
	* View Layout
	*
	* @return
	*/
	protected $layout = 'users::layout.main';

	/**
	* Controller Constructor
	*
	* @return 
	*/
	public function __construct() 
	{	
		if(Config::get('users::layout.set'))
		{
			$this->layout = Config::get('users::layout.name');
		}

		$this->beforeFilter('loginRequired', array('only'=>array('getDashboard','getIndex')));
		$this->beforeFilter('afterLogin', array('only'=>array('getLogin','getIndex','getRegister')));
	}

	/**
	* Get login view.
	*
	* @return Illuminate\View\View
	*/
	public function getLogin()
	{
		$this->layout->content = \View::make('users::login');
	}

	/**
	* Get register view.
	*
	* @return Illuminate\View\View
	*/
	public function getRegister()
	{
		$this->layout->content = \View::make('users::register');
	}
    
    /**
	* Get profile view.
	*
	* @return Illuminate\View\View
	*/
	public function getProfile($username)
	{
        $user = User::where('username','=',$username)->firstOrFail();
                  
		$this->layout->content = \View::make('users::profile')->with('user',$user);
	}
    
    /**
	* Get settings view.
	*
	* @return Illuminate\View\View
	*/
	public function getSettings()
	{
		$this->layout->content = \View::make('users::settings');
	}
}
