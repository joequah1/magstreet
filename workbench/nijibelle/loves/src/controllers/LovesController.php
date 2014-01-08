<?php namespace Nijibelle\Loves;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Config;
use Illuminate\Routing\Controllers\Controller;

use Nijibelle\Users\User;

class LovesController extends \BaseController {

    /**
	* Love
	*
	* @return 
	*/
    public function postLove($id, $target)
    {
        $config = Config::get('loves::from');
        
        $table = $config[$target]['table'];
        $column = $config[$target]['column'];
        $model = "Nijibelle\Loves\\".$config[$target]['model'];
        
        $userId = \Auth::user()->id;
        //User::find($userId)->loveBlock()->attach($id);
        $insert = new $model;
        $insert->user_id = $userId;
        $insert->$column = $id;
        $insert->save();
    }
    
    /**
	* Un love
	*
	* @return 
	*/
    public function postUnLove($id, $target)
    {
        $config = Config::get('loves::from');
        
        $table = $config[$target]['table'];
        $column = $config[$target]['column'];
        $model = "Nijibelle\Loves\\".$config[$target]['model'];
        
        $userId = \Auth::user()->id;
        //User::find($userId)->loveBlock()->detach($id);
        $delete = $model::where('user_id','=',$userId)->where($column,'=',$id)->delete();
        //$delete->delete();
    }
}
