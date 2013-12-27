<?php namespace Nijibelle\Users;


class Role extends \Eloquent {

    /**
    * Validation rules for registration
    *
    */
    public static $rules = array(
        'role'=>'required|regex:/^([a-z\x20])+$/i|min:2',
        'description'=>'required|regex:/^([a-z\x20])+$/i|min:2'
    );
    
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'roles';
    
    /*
    * Soft Delete
    */
    protected $softDelete = true;
    
    public function user()
    {
        return $this->belongsTo('Nijibelle\Users\User', 'created_by');
    }

}
