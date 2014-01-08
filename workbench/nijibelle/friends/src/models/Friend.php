<?php namespace Nijibelle\Friends;


class Friend extends \Eloquent {
   
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'friends';
    
    /*
    * Soft Delete
    */
    protected $softDelete = true;
    
    public function user()
    {
        return $this->belongsTo('Nijibelle\Users\User','user_id');
    }
    
    public function friend()
    {
        return $this->belongsTo('Nijibelle\Users\User','friend_user_id');
    }
    
}
