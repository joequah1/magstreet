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
        
        $count = $this->getCount($id, $from) - 5;
        
        $data = array('form_options'=>$form_options, 'id'=>$id, 'from' => $from, 'offset' => $count);
        
		$this->layout->content = \View::make('comments::comments')->with('data',$data);	
    }
    
    /*
    * Get Previous Comments
    */
    public function getPreviousComments($offset, $target_id, $from)
    {
        $config = Config::get('comments::from');
        
        $table = $config[$from]['table'];
        $where = $config[$from]['column'];
        
        $limit = 5;
        
        if($offset < 0)
        {
            $limit += $offset;
            $offset = 0;
        }
        
        $comments = Comment::join($table,$table.'.comment_id','=','comments.id')
            ->where($where,'=',$target_id)->limit($limit)->offset($offset)->get();
        
        $data = array('previous'=>$offset, 'comments'=>$comments);
        
        return \View::make('comments::previousComments')->with('data',$data);	
    }
    
    /**
	* Comments Real Time
	*
	* @return 
	*/
    public function getRealTime($offset,$target_id,$from)
    {
        $config = Config::get('comments::from');
        
        $table = $config[$from]['table'];
        $where = $config[$from]['column'];
        
        $comments = Comment::join($table,$table.'.comment_id','=','comments.id')
            ->where($where,'=',$target_id)->limit(20)->offset($offset)->get();
        
        $data = array('latest'=>$offset, 'comments'=>$comments);
        
        return \View::make('comments::realtime')->with('data',$data);	
    }
    
    /**
	* Get Comment Count
	*
	* @return 
	*/
    public function getCount($target_id, $from)
    {
        $config = Config::get('comments::from');
        
        $table = $config[$from]['table'];
        $where = $config[$from]['column'];
        
        $count = Comment::join($table,$table.'.comment_id','=','comments.id')
            ->where($where,'=',$target_id)->count();
        
        return $count;
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
