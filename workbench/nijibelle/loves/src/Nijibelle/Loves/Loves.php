<?php
namespace Nijibelle\Loves;

use Illuminate\View\Environment;
use Illuminate\Config\Repository;

use Nijibelle\Users\User;

class Loves {

	/**
	* Illuminate view environment.
	*
	* @var Illuminate\View\Environment
	*/
	protected $view;

	/**
	* Illuminate config repository.
	*
	* @var Illuminate\Config\Repository
	*/
	protected $config;

	/**
	* 
	*
	* @var 
	*/
	protected $url;

	/**
	* Create a new profiler instance.
	*

	* @param  Illuminate\View\Environment  $view
	* @return void
	*/
	public function __construct(Environment $view, Repository $config, $url)
	{
		$this->view = $view;
		$this->config = $config;
		$this->url = $url;
	}
    
    public function getLoveButton($id, $from)
    {   
        $userId = 0;
        
        if(\Users::isLogin())
        {
            $userId = \Auth::user()->id;
        }
        
        $config = $this->config->get('loves::from');
        $model = "Nijibelle\Loves\\".$config[$from]['model'];
        $column = $config[$from]['column'];
        
        $love = $model::where('user_id','=',$userId)->where($column,'=',$id)->get();
        
        $count = $model::where($column,'=',$id)->count();
        
        $data = array('love'=>$love, 'block'=>$id, 'count'=>$count, 'target'=>$from);
        
        return $this->view->make('loves::loveButton')->with('data',$data);; 
    }

	/**
	 * Enable the users.
	 *
	 * @return void
	 */
	public function enable()
	{
	    $this->config->set('users::enabled', true);
	}

}

