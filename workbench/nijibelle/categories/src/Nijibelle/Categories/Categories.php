<?php
namespace Nijibelle\Categories;

use Illuminate\View\Environment;
use Illuminate\Config\Repository;

class Categories {

	/**
	* Illuminate view environment.
	*
	* @var Illuminate\View\Environment
	*/
	protected $view;

	/**
	* Illuminate config repository.
	*
	* @var Illuminate\Config\Repository
	*/
	protected $config;

	/**
	* 
	*
	* @var 
	*/
	protected $url;

	/**
	* Create a new profiler instance.
	*

	* @param  Illuminate\View\Environment  $view
	* @return void
	*/
	public function __construct(Environment $view, Repository $config, $url)
	{
		$this->view = $view;
		$this->config = $config;
		$this->url = $url;
	}
    
    /**
	 * Get drop down list
	 *
	 * @return view
	 */
    public function getDropDownList()
    {
        $categories = Category::lists('name');
        
        return $this->view->make('categories::dropdownlist')->with('categories',$categories);	
    }
    
    public function getRefine()
    {
        
        $categories = Category::all();
       
        return $this->view->make('categories::refine')->with('categories',$categories);
    }
    
	/**
	 * Enable the users.
	 *
	 * @return void
	 */
	public function enable()
	{
	    $this->config->set('users::enabled', true);
	}

}

