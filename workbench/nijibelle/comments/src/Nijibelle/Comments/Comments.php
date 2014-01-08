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
        
        $count = $this->getCount($id, $from) - 5;
        
        $data = array('form_options'=>$form_options, 'id'=>$id, 'from' => $from, 'offset' => $count);
        
		return $this->view->make('comments::comments')->with('data',$data);	    
    }
    
    public function getCommentCount($id, $from)
    {
        $config = $this->config->get('comments::from');
        
        $table = $config[$from]['table'];
        $where = $config[$from]['column'];
        
        $count = Comment::join($table,$table.'.comment_id','=','comments.id')
            ->where($where,'=',$id)->count();
        
        $data = array('count' => $count);
        
        return $this->view->make('comments::commentCount')->with('data',$data);	 
    }
    
    /**
	* Get Comment Count
	*
	* @return 
	*/
    public function getCount($id, $from)
    {
        $config = $this->config->get('comments::from');
        
        $table = $config[$from]['table'];
        $where = $config[$from]['column'];
        
        $count = Comment::join($table,$table.'.comment_id','=','comments.id')
            ->where($where,'=',$id)->count();
        
        return $count;
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

