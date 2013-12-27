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
    public function postAddFriend($id, $friend_id)
    {
        $friend = new Friend;
        $friend->user_id = $id;
        $friend->friend_user_id = $friend_id;
        $friend->save();     
    }
    
    /**
    * Get friends list
    */
    public function getFriendList($id)
    {
        $friends = Friend::where('user_id','=',$id)->get();
        
        $this->layout->content = \View::make('friends::friendlist')->with('friends',$friends);
    }
}
