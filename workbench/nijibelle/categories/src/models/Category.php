<?php namespace Nijibelle\Categories;

class Category extends \Eloquent {
    
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'categories';
    
    /*
    * Soft Delete
    */
    protected $softDelete = true;

}