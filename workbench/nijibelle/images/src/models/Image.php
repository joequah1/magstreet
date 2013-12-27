<?php namespace Nijibelle\Images;

class Image extends \Eloquent {

    /**
    * Validation rules for registration
    *
    */
    public static $rules = array(
        'image'=>'required|mimes:jpeg,bmp,png,gif,jpg'
    );
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'images';

	/*
	* Soft Delete
	*/
	protected $softDelete = true;
    
    public function block()
    {
        return $this->hasMany('Nijibelle\Blocks\Block','image_id');
    }
    
    public function profileImage()
    {
        return $this->belongsToMany('Nijibelle\Users\User','profile_image','image_id','user_id');		
    }
}
