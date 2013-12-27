<?php
namespace Nijibelle\Shares;

use Illuminate\View\Environment;
use Illuminate\Config\Repository;

class Shares {

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
    
    public function getShareButton($id_share, $image, $target_share)
    { 
        $data = array('target_share'=>$target_share, 'id_share'=>$id_share, 'image'=>$image);
        
        return $this->view->make('shares::sharebutton')->with('data',$data);;     
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

