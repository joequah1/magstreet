<?php namespace Nijibelle\Blocks;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Config;
use Illuminate\Routing\Controllers\Controller;

use Nijibelle\Users\User;

class LoveController extends \BaseController {

    /**
	* Love
	*
	* @return 
	*/
    public function postLove($id)
    {
        $userId = \Auth::user()->id;
        User::find($userId)->loveBlock()->attach($id);
    }
    
    /**
	* Un love
	*
	* @return 
	*/
    public function postUnLove($id)
    {
        $userId = \Auth::user()->id;
        User::find($userId)->loveBlock()->detach($id);
    }
}
