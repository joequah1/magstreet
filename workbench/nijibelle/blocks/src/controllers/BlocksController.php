<?php namespace Nijibelle\Blocks;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Config;
use Illuminate\Routing\Controllers\Controller;

use Nijibelle\Images\Image;

class BlocksController extends \BaseController {

	/**
	* View Layout
	*
	* @return
	*/
	protected $layout = 'blocks::layout.main';

	/**
	* Controller Constructor
	*
	* @return 
	*/
	public function __construct() 
	{	
		if(Config::get('blocks::layout.set'))
		{
			$this->layout = Config::get('blocks::layout.name');
		}
	}

    /**
	* 
	*
	* @return 
	*/
	public function getIndex($id = null)
	{  $id = 1;
     
     /*
     $not = \DB::table('share_blocks')->select('share_blocks.block_id as id')
         ->join('shares','share_blocks.share_id','=','shares.id')->where('shares.created_by', '=', $id)->lists('id');
     
     $first = \DB::table('blocks')
         ->select('blocks.id as id','blocks.caption as caption','images.path as path','users.firstname as firstname','users.lastname as lastname','blocks.category_id as category_id','blocks.created_at as created_at') 
         ->join('users','blocks.created_by','=','users.id')
         ->join('images','blocks.image_id','=','images.id')
         ->where('blocks.created_by', '=', $id)->whereNotIn('blocks.id',$not)
         ->orderBy('created_at','desc')->groupBy('id');
        
     
     $second = \DB::table('blocks')
         ->select('blocks.id as id','shares.caption as caption','images.path as path','users.firstname as firstname','users.lastname as lastname','blocks.category_id as category_id','shares.created_at as created_at')
         ->join('share_blocks','share_blocks.block_id','=','blocks.id')
         ->join('shares','share_blocks.share_id','=','shares.id')
         ->join('users','shares.created_by','=','users.id')
         ->join('images','blocks.image_id','=','images.id')
         ->where('shares.created_by', '=', $id)
         ->union($first)->groupBy('id')->get();
     */
     
     $first = \DB::table('blocks')
         ->select('blocks.id as id','blocks.caption as caption','images.path as path','users.firstname as firstname','users.lastname as lastname','blocks.category_id as category_id','blocks.created_at as created_at') 
         ->join('users','blocks.created_by','=','users.id')
         ->join('images','blocks.image_id','=','images.id')
         ->where('blocks.created_by', '=', $id)
         ->orderBy('created_at','desc');
        
     
     $second = \DB::table('blocks')
         ->select('blocks.id as id','shares.caption as caption','images.path as path','users.firstname as firstname','users.lastname as lastname','blocks.category_id as category_id','shares.created_at as created_at')
         ->join('share_blocks','share_blocks.block_id','=','blocks.id')
         ->join('shares','share_blocks.share_id','=','shares.id')
         ->join('users','shares.created_by','=','users.id')
         ->join('images','blocks.image_id','=','images.id')
         ->where('shares.created_by', '=', $id)
         ->union($first)->get();
     
     
        $blocks = Block::where('created_by', '=', $id)->take(10)->get();
        
        $this->layout->content = \View::make('blocks::index')->with('blocks',$second);	
	}
    
    /**
	* Get Add Block View
	*
	* @return 
	*/
    public function getAdd()
    {
        $form_options = array (
            'action' => 'Nijibelle\Blocks\BlocksController@postBlocks',
            'class'  => 'form-signup',
            'files'  => true
        );

		$this->layout->content = \View::make('blocks::addBlock')->with('form_options',$form_options);	
    }
    
    /**
	* Get Full Block View
	*
	* @return 
	*/
    public function getBlock($id, $comment_table_from, $comment_target_id = null)
    {
        $block = Block::find($id);
        
        //checkingn id for commenting 
        if($comment_table_from == "blocks")
            $comment_target_id = $id;
       
        $data = array('block'=>$block,'comment_table_from'=>$comment_table_from, 'comment_target_id' => $comment_target_id);
        
        return \View::make('blocks::block')->with('data',$data);
    }
    
    
    /**
	* Add new Block 
	*
	* @return 
	*/
    public function postBlocks()
    {
        $validator = Validator::make(Input::all(), Block::$rules);
        
		if($validator->passes())
		{
            $file            = Input::file('image');
            $destinationPath = public_path().'/img/';
            $filename        = str_random(50) . '_' . $file->getClientOriginalName();
            $uploadSuccess   = $file->move($destinationPath, $filename);
            
            $userId = \Auth::user()->id;
            
			$image = new Image;
			$image->path = '/img/' . $filename;
            $image->created_by =  $userId;
			$image->save();
			
			$insertedId = $image->id;
			
            $block = new Block;
            $block->caption = Input::get('caption');
            $block->image_id = $insertedId;
            $block->created_by = $userId;
            $block->category_id = Input::get('category')+1;
            $block->save();
		
			
			
			return Redirect::to(Config::get('blocks::route').'/')->with('Your block uploaded!');

		}else
		{
			    return Redirect::to(Config::get('blocks::route').'/')->with('message', 'The following errors occurred')->withErrors($validator)->withInput();
		}
    }

}
