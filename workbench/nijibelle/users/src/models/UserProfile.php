<?php namespace Nijibelle\Users;

class UserProfile extends \Eloquent {
    
	/**
	* Validation rules for registration
	*
	*/
	public static $rules = array(
		'description'=>'required'
	);
    

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'user_profile';
    
    public $timestamps = false;

}
