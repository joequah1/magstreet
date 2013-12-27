<?php namespace Nijibelle\Images;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Config;
use Illuminate\Routing\Controllers\Controller;

class ImagesController extends \BaseController {

    /**
	* View Layout
	*
	* @return
	*/
	protected $layout = 'images::layout.main';

	/**
	* Controller Constructor
	*        
	* @return 
	*/
	public function __construct() 
	{	
		if(Config::get('images::layout.set'))
		{
			$this->layout = Config::get('images::layout.name');
		}
	}
    
    /**
	* Get Upload View
	*        
	* @return 
	*/
    public function getUpload()
    {
        //form parameters
        $form_options = array (
            'action' => 'Nijibelle\Images\ImagesController@postAddImage',
            'class'  => 'form-signup',
            'files'  => true
        );
        
		$this->layout->content = \View::make('images::uploadImage')->with('form_options',$form_options);	
    }
    
    /**
	* Get Upload Profile Image View
	*        
	* @return 
	*/
    public function getProfile()
    {
        //form parameters
        $form_options = array (
            'action' => 'Nijibelle\Images\ImagesController@postProfileImage',
            'class'  => 'form-signup dropzone',
            'id' => '',
            'files'  => true
        );
        
		$this->layout->content = \View::make('images::uploadProfileImage')->with('form_options',$form_options);	
    }
    
    /**
	* Post add Image
	*        
	* @return 
	*/
   public function postAddImage()
   {
       $validator = Validator::make(Input::all(), Image::$rules);
        
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
			
			return Redirect::to(\URL::previous())->with('');

		}else
		{
			 return Redirect::to(\URL::previous())->with('message', 'The following errors occurred')->withErrors($validator)->withInput();
		}
   }
    
    /**
	* Post add Profile Image
	*        
	* @return 
	*/
    public function postProfileImage()
   {
       $validator = Validator::make(Input::all(), Image::$rules);
        
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
            
            $profile_image = ProfileImage::where('user_id','=',$userId)->get();
            if(!$profile_image->isEmpty())
            {
                $temp = Image::find($profile_image[0]->image_id)->profileImage()->detach($userId);
            }
                
            
            $image->profileImage()->attach($userId);
            
			return Redirect::to(\URL::previous())->with('Profile Image Uploaded');

		}else
		{
			 return Redirect::to(\URL::previous())->with('message', 'The following errors occurred')->withErrors($validator)->withInput();
		}
   }
    
    public function postLove($id)
    {
        $userId = \Auth::user()->id;
        User::find($userId)->loveImage()->attach($id);
    }
    
    public function postUnLove($id)
    {
        $userId = \Auth::user()->id;
        User::find($userId)->loveImage()->detach($id);
    }
}
