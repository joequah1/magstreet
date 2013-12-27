<?php namespace Nijibelle\Users;

class UserRoles extends \Eloquent {
	
	protected $table = "user_roles";
    
    public function roles()
    {
        return $this->belongsTo('Nijibelle\Users\Role','role_id');
    }
} 
