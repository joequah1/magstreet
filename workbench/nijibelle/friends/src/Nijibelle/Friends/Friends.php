<?php
namespace Nijibelle\Friends;

use Illuminate\View\Environment;
use Illuminate\Config\Repository;

class Friends {

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
    *
    */
    public function getFriendsListRoute($id)
    {
        return "/friends/list/".$id;
    }

    /**
    * Get friends list
    */
    public function getFriendsListView($id)
    {
        $friends = Friend::where('user_id','=',$id)->get();
        
        return $this->view->make('friends::friendslist')->with('friends',$friends);
    }
    
    /**
    *
    */
    public function getFriendButton($userId, $friendId)
    {
        $friend = Friend::where('user_id','=',$userId)->where('friend_user_id','=',$friendId)->count();
        
        $data = array('user'=>$userId, 'friend'=>$friendId, 'true'=>$friend);
        
        return $this->view->make('friends::friendButton')->with('data',$data);
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

