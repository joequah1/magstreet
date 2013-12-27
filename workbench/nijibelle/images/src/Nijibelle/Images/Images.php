<?php
namespace Nijibelle\Images;

use Illuminate\View\Environment;
use Illuminate\Config\Repository;

class Images {

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
    
    public function getUploadImage()
    {
        $form_options = array (
            'action' => 'Nijibelle\Images\ImagesController@postAddImage',
            'class'  => 'form-signup',
            'files'  => true
        );

        return $this->view->make('images::uploadImage')->with('form_options',$form_options);	
    }
    
    public function getUploadProfileImage()
    {
        $form_options = array (
            'action' => 'Nijibelle\Images\ImagesController@postProfileImage',
            'class'  => 'form-signup dropzone',
            'id' => 'my-awesome-dropzone',
            'files'  => true
        );

        return $this->view->make('images::uploadProfileImage')->with('form_options',$form_options);	
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

