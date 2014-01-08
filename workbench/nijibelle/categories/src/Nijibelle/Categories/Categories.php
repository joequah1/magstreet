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
        $id = 1;
        
        $first = \DB::table('categories')
            ->select(\DB::raw(" categories.id as id, categories.name as name"))
             ->join('blocks','blocks.category_id','=','categories.id')
             ->where('blocks.created_by', '=', $id);
        
        $second = \DB::table('categories')
            ->select(\DB::raw(" categories.id as id, categories.name as name"))
            ->join('blocks','blocks.category_id','=','categories.id')
            ->join('share_blocks','share_blocks.block_id','=','blocks.id')
            ->join('shares','share_blocks.share_id','=','shares.id')
            ->where('shares.created_by', '=', $id)
            ->union($first)
            ->get();

        return $this->view->make('categories::refine')->with('categories',$second);
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

