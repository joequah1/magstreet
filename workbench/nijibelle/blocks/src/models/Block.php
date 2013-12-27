<?php namespace Nijibelle\Blocks;

class Block extends \Eloquent {

    /**
    * Validation rules for registration
    *
    */
    public static $rules = array(
        'category'=>'required|min:1',
        'image'=>'required|mimes:jpeg,bmp,png,gif'
    );
    
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'blocks';

	/*
    * Soft Delete
    */
    protected $softDelete = true;

    /**
	 * Relation to image model
	 *
	 * @return model
	 */
    public function image()
    {
        return $this->belongsTo('Nijibelle\Images\Image','image_id');
    }
    
    /**
	 * Relation to image model
	 *
	 * @return model
	 */
    public function person()
    {
        return $this->belongsTo('Nijibelle\Users\User','created_by');
    }
    
    /**
	 * Relation to love model
	 *
	 * @return model
	 */
    public function love()
    {
        return $this->belongsToMany('Nijibelle\Users\User','block_loves','block_id','user_id');
    }
    
    public function category()
    {
        return $this->belongsTo('Nijibelle\Categories\Category','category_id');
    }

}