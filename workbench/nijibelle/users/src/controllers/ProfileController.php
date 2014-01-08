<?php namespace Nijibelle\Users;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Config;
use Illuminate\Routing\Controllers\Controller;

use Nijibelle\Users\User;

class ProfileController extends \BaseController {

	/**
	* Post Update Profile
	*
	* @return 
	*/
	public function postUpdate()
	{
		$validator = Validator::make(Input::all(), User::$rules_update);
        
		if($validator->passes())
		{
			$user = User::find(Input::get('userId'));
			$user->firstname = Input::get('firstname');
			$user->lastname = Input::get('lastname');
			$user->gender = Input::get('gender');
			$user->dob = Input::get('dob');
			$user->save();
			
			return Redirect::to('u/'.$user->username)->with('message', 'Your Profile has been updated!');

		}else
		{
			    return Redirect::to(Config::get('users::route').'/profile')->with('message', 'The following errors occurred')->withErrors($validator)->withInput();
		}
	}
    
    /**
	* Post update Password
	*
	* @return 
	*/
	public function postUpdatePassword()
	{
		//$validator = Validator::make(Input::all(), User::$rules_update);
        
        $credential = array('password'=>Input::get('password'));
        if (\Auth::validate($credential))
        {
            
            $validator = Validator::make(Input::all(), User::$rules_password);
        
            if($validator->passes())
            {
                $user = User::find(Input::get('userId'));
                $user->password = \Hash::make(Input::get('password_new'));
                $user->save();
                
                return Redirect::to('u/'.$user->username)->with('message', 'Your Profile has been updated!');
    
            }else
            {
                    return Redirect::to(Config::get('users::route').'/settings')->with('message', 'The following errors occurred')->withErrors($validator)->withInput();
            }
            
        }else
        { 
            return Redirect::to('/user/settings')->with('message','Incorrect Password.');
        }
        

	}
    
    /**
	* Post description
	*
	* @return 
	*/
    public function postDescription()
    {
        $validator = Validator::make(Input::all(), UserProfile::$rules);
        if($validator->passes())
        {
            $update = array('description'=>Input::get('description'));
            $description = UserProfile::where('created_by','=',Input::get('userId'))->update($update) ;
            
            return Redirect::to('u/'.\Auth::user()->username)->with('message', 'Your Profile has been updated!');
        }else
        {
                return Redirect::to(Config::get('users::route').'/settings')->with('message', 'The following errors occurred')->withErrors($validator)->withInput();
        }
    }
}
