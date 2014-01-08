<?php namespace Nijibelle\Friends;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Config;
use Illuminate\Routing\Controllers\Controller;

class FriendController extends \BaseController {

    /**
	* View Layout
	*
	* @return
	*/
	protected $layout = 'friends::layout.main';

	/**
	* Controller Constructor
	*
	* @return 
	*/
	public function __construct() 
	{	
		if(Config::get('friends::layout.set'))
		{
			$this->layout = Config::get('friends::layout.name');
		}
	}
    
    /**
    * Add friends
    */
    public function postAddFriend($userId, $friendId)
    {
        $friend = new Friend;
        $friend->user_id = $userId;
        $friend->friend_user_id = $friendId;
        $friend->save();     
        
    }
    
    /**
    *
    */
    public function postUnFriend($userId, $friendId)
    {
        Friend::where('user_id','=',$userId)->where('friend_user_id','=',$friendId)->delete();
    }
    
    /**
    * Get friends list
    */
    public function getFriendList($id)
    {
        $friends = Friend::where('user_id','=',$id)->get();
        
        $this->layout->content = \View::make('friends::friendslist')->with('friends',$friends);
    }
}
