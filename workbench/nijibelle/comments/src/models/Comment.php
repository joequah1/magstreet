<?php namespace Nijibelle\Comments;

class Comment extends \Eloquent {

    /**
	* Validation rules for registration
	*
	*/
	public static $rules = array(
		'comment'=>'required'
	);
    
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'comments';
    
    /**
	 * Relation to image model
	 *
	 * @return model
	 */
    public function person()
    {
        return $this->belongsTo('Nijibelle\Users\User','created_by');
    }
    
    public function block()
	{
		return $this->belongsToMany('Nijibelle\Blocks\Block','block_comments','comment_id','block_id');
	}
    
    public function share()
	{
		return $this->belongsToMany('Nijibelle\Shares\Share','share_comments','comment_id','share_id');
	}

}