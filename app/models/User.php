<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

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