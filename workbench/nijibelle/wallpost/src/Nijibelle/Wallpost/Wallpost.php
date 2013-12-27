<?php
namespace Nijibelle\Wallpost;

use Illuminate\View\Environment;
use Illuminate\Config\Repository;

class Wallpost {

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
	* Get dashboard view.
	*
	* @return Illuminate\View\View
	*/
	public function getDashboard()
	{
		return $this->view->make('users::wallpost');
	}

	/**
	 * Enable the users.
	 *
	 * @return void
	 */
	public function enable()
	{
	    $this->config->set('wallpost::enabled', true);
	}

}

