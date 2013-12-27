<?php
namespace Nijibelle\Comments;

use Illuminate\View\Environment;
use Illuminate\Config\Repository;

class Comments {

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
    
    public function getComments($id, $from)
    {
        $form_options = array (
            'action' => 'Nijibelle\Comments\CommentsController@postUpdateComment',
            'id'  => 'commentForm'
        );
        
        $data = array('form_options'=>$form_options, 'id'=>$id, 'from' => $from);
        
		return $this->view->make('comments::comments')->with('data',$data);	    
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

