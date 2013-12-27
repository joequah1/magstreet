<?php namespace Nijibelle\Users;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Config;
use Illuminate\Routing\Controllers\Controller;

use Nijibelle\Users\User;

class RegistrationController extends \BaseController {

	/**
	* Post Register
	*
	* @return 
	*/
	public function postRegister()
	{
		$validator = Validator::make(Input::all(), User::$rules);
        
		if($validator->passes())
		{
            $email = Input::get('email');
            $firstname = Input::get('firstname');
            $lastname = Input::get('lastname');
            $birthday = Input::get('dob');
                
            
            $username = $this->getUsername($email, $firstname, $lastname, $birthday);
            
			$user = new User;
			$user->firstname = $firstname;
			$user->lastname = $lastname;
			$user->email = $email;
            $user->username = strtolower($username);
			$user->password = \Hash::make(Input::get('password'));
			$user->gender = Input::get('gender');
			$user->dob = $birthday;
			$user->save();

			$user->roles()->attach(1);
		
			return Redirect::to(Config::get('users::route').'/login')->with('message', 'Thanks for registering!');

		}else
		{
			    return Redirect::to(Config::get('users::route').'/register')->with('message', 'The following errors occurred')->withErrors($validator)->withInput();
		}
	}
    
    /**
    *   Generate username for user
    */
    public function getUsername($email, $firstname, $lastname, $date)
    {
        $parts = explode("@", Input::get('email'));
        $username = $parts[0];
        $val_mail = array('username'=>$username);

        $validate_email = Validator::make($val_mail, User::$rules_username);
        if($validate_email->passes())
        {
            return $username;
        }
        
        /*
        * Get username from firstname + first character of lastname
        */
        $username = str_replace(' ','.',$firstname).substr($lastname, 0, 1);
        $val_mail = array('username'=>$username);
        
        $validate_email = Validator::make($val_mail, User::$rules_username);
        if($validate_email->passes())
        {
            return $username;
        }
        
        /*
        * Get username from firstname + first character of lastname + day of birthday
        */
        $username = str_replace(' ','.',$firstname).substr($lastname, 0, 1). date("d",$date);
        $val_mail = array('username'=>$username);
        
        $validate_email = Validator::make($val_mail, User::$rules_username);
        if($validate_email->passes())
        {
            return $username;
        }
        
        /*
        * Get username from firstname + first character of lastname + month of birthday
        */
        $username = str_replace(' ','.',$firstname).substr($lastname, 0, 1). date("m",$date);
        $val_mail = array('username'=>$username);
        
        $validate_email = Validator::make($val_mail, User::$rules_username);
        if($validate_email->passes())
        {
            return $username;
        }
        
        /*
        * Get username from firstname + first character of lastname + year of birthday
        */
        $username = str_replace(' ','.',$firstname).substr($lastname, 0, 1). date("y",$date);
        $val_mail = array('username'=>$username);
        
        $validate_email = Validator::make($val_mail, User::$rules_username);
        if($validate_email->passes())
        {
            return $username;
        }
         
    }
}
