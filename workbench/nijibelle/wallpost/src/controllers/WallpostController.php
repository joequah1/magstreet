<?php namespace Nijibelle\Users;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Config;
use Illuminate\Routing\Controllers\Controller;

class WallpostController extends \BaseController {
	
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

	public function postBlock()
	{
		
	}
}
