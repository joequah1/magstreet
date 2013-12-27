<?php namespace Nijibelle\Categories;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Config;
use Illuminate\Routing\Controllers\Controller;

class CategoriesController extends \BaseController {

	/**
	* View Layout
	*
	* @return
	*/
	protected $layout = 'categories::layout.main';

	/**
	* Controller Constructor
	*
	* @return 
	*/
	public function __construct() 
	{	
		if(Config::get('categories::layout.set'))
		{
			$this->layout = Config::get('categories::layout.name');
		}
	}
    
    public function getDropDown()
    {
        $categories = Category::lists('name');
        
        $this->layout->content = \View::make('categories::dropdownlist')->with('categories',$categories);	
    } 

}
