<?php namespace Nijibelle\Shares;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Config;
use Illuminate\Routing\Controllers\Controller;

class SharesController extends \BaseController {

    
    public function getAdd($target_share, $id_share, $image)
    {
        $form_options = array (
            'action' => 'Nijibelle\Shares\SharesController@postNewShare',
            'id' => 'share-form'
        );
        
        $data = array('form_options'=>$form_options, 'target_share'=>$target_share,'id_share'=>$id_share, 'image'=>$image);
        
        return \View::make('shares::shareadd')->with('data',$data);
    }
    
    
    public function postNewShare()
    {
        $target = Input::get('target_share');
        $id = Input::get('id_share');
        
        $share = new Share;
        $share->caption = Input::get('caption');
        $share->created_by = \Auth::user()->id;
        $share->save();
        
        $config = Config::get('shares::from');
                
        $function = $config[$target]['function'];
        
        $share->$function()->attach($id);
        
        return Redirect::to(Config::get('blocks::route').'/');
    }
}
