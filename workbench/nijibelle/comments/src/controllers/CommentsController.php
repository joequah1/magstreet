<?php namespace Nijibelle\Comments;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Config;
use Illuminate\Routing\Controllers\Controller;

class CommentsController extends \BaseController {

	/**
	* View Layout
	*
	* @return
	*/
	protected $layout = 'comments::layout.main';

	/**
	* Controller Constructor
	*
	* @return 
	*/
	public function __construct() 
	{	
		if(Config::get('comments::layout.set'))
		{
			$this->layout = Config::get('comments::layout.name');
		}
	}
    
    /**
	* Get Comments View
	*
	* @return 
	*/
    public function getComment($id, $from)
    {   
        $form_options = array (
            'action' => 'Nijibelle\Comments\CommentsController@postUpdateComment',
            'id'  => 'commentForm'
        );
        
        $data = array('form_options'=>$form_options, 'id'=>$id, 'from' => $from);
        
		$this->layout->content = \View::make('comments::comments')->with('data',$data);	
    }
    
    /**
	* Comments Real Time
	*
	* @return 
	*/
    public function getRealTime($id,$block,$from)
    {
        $config = Config::get('comments::from');
        
        $table = $config[$from]['table'];
        $where = $config[$from]['column'];
        
        $comments = Comment::where('id','>',$id)
            ->join($table,$table.'.comment_id','=','comments.id')
            ->where($where,'=',$block)->get();
        
        $data = array('last'=>$id, 'comments'=>$comments);
        
        return \View::make('comments::realtime')->with('data',$data);	
    }
    
    /**
	* Add new comment 
	*
	* @return 
	*/
    public function postUpdateComment()
    {   
        $validator = Validator::make(Input::all(), Comment::$rules);
        
		if($validator->passes())
		{            
            $userId = \Auth::user()->id;
            $id =  Input::get('id');
            $comment = Input::get('comment');
            $from = Input::get('from');
			
            $comm = new Comment;
            $comm->message = $comment;
            $comm->created_by = $userId;
            $comm->save();
            
            $config = Config::get('comments::from');
                
            $function = $config[$from]['function'];
            
            $comm->$function()->attach($id);
            
            return '{"data":"success"}';
		}
       
        $message = array('data'=>$validator->messages());
        return $message;
    }
    
    /**
    * Delete Comment
    *
    */
    public function postRemove($id)
    {
        Comment::find($id)->delete();
    }

}
