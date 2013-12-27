<?php namespace Nijibelle\Shares;


class Share extends \Eloquent {
   
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'shares';
    
    public function blocks()
	{
        return $this->belongsToMany('Nijibelle\Blocks\Block','share_blocks','share_id','block_id');	
	}
}
