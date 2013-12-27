<?php namespace Nijibelle\Users;

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends \Eloquent implements UserInterface, RemindableInterface {
    
	/**
	* Validation rules for registration
	*
	*/
	public static $rules = array(
		'firstname'=>'required|regex:/^([a-z\x20])+$/i|min:2',
		'lastname'=>'required|regex:/^([a-z\x20])+$/i|min:2',
		'email'=>'required|email|unique:users',
		'password'=>'required|alpha_num|between:6,16|confirmed',
		'password_confirmation'=>'required|alpha_num|between:6,16',
		'dob'=>'required|date',
		'gender'=>'required'
	);
    
    /**
	* Validation rules for profile update
	*
	*/
	public static $rules_update = array(
		'firstname'=>'required|regex:/^([a-z\x20])+$/i|min:2',
		'lastname'=>'required|regex:/^([a-z\x20])+$/i|min:2',
		'dob'=>'required|date',
		'gender'=>'required'
	);
    
    /**
	* Validation rules for registration
	*
	*/
	public static $rules_password = array(
		'password_new'=>'required|alpha_num|between:6,16|confirmed',
		'password_new_confirmation'=>'required|alpha_num|between:6,16'
	);
    
    /**
	* Validation rules for username
	*
	*/
	public static $rules_username = array(
		'username'=>'required|regex:/^[a-zA-Z0-9][\w\.]+[a-zA-Z0-9]$/i|between:3,16|unique:users'
	);
    
	/**
	* Facebook login validation
	*
	*/
	public static $rules_fb = array(
		'email'=>'required|email|unique:users'
	);

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password');

	/**
	 * Get the unique identifier for the user.
	 *
	 * @return mixed
	 */
	public function getAuthIdentifier()
	{
		return $this->getKey();
	}

	/**
	 * Get the password for the user.
	 *
	 * @return string
	 */
	public function getAuthPassword()
	{
		return $this->password;
	}

	/**
	 * Get the e-mail address where password reminders are sent.
	 *
	 * @return string
	 */
	public function getReminderEmail()
	{
		return $this->email;
	}

    /**
    * Relations to user roles table
    *
    *
    */
	public function roles()
	{
        return $this->belongsToMany('Nijibelle\Users\Role','user_roles','user_id','role_id');
		//return $this->hasMany('Nijibelle\Users\UserRoles');		
	}
    
    /**
    * Relations to image table for profile image
    *
    *
    */
	public function profileImage()
	{
		return $this->belongsToMany('Nijibelle\Images\Image','profile_image','user_id','image_id');
	}
    
    public function loveImage()
    {
        return $this->belongsToMany('Nijibelle\Images\Image','image_loves','user_id','image_id');
    }
    
    public function loveBlock()
    {
        return $this->belongsToMany('Nijibelle\Blocks\Block','block_loves','user_id','block_id');
    }

}
