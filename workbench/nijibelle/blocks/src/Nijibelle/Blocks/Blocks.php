<?php
namespace Nijibelle\Blocks;

use Illuminate\View\Environment;
use Illuminate\Config\Repository;

use Nijibelle\Users\User;

class Blocks {

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

	public function getAddBlock()
	{ 
        $form_options = array (
            'action' => 'Nijibelle\Blocks\BlocksController@postBlocks',
            'class'  => 'form-signup',
            'files'  => true
        );

        return $this->view->make('blocks::addBlock')->with('form_options',$form_options);	
    }
    
    public function getWall($id)
	{    
        $first = \DB::table('blocks')
            ->select(\DB::raw(" 'blocks' as tablename, blocks.id as id, null as share, blocks.caption as caption, images.path as path, users.firstname as firstname, users.lastname as lastname, blocks.category_id as category_id, blocks.created_at as created_at"))
            
             ->join('users','blocks.created_by','=','users.id')
             ->join('images','blocks.image_id','=','images.id')
             ->where('blocks.created_by', '=', $id)
             ->orderBy('created_at','desc');
        
        $second = \DB::table('blocks')
            ->select(\DB::raw(" 'shares' as tablename, blocks.id as id, shares.id as share, shares.caption as caption, images.path as path, users.firstname as firstname, users.lastname as lastname, blocks.category_id as category_id, shares.created_at as created_at"))
            ->join('share_blocks','share_blocks.block_id','=','blocks.id')
            ->join('shares','share_blocks.share_id','=','shares.id')
            ->join('users','shares.created_by','=','users.id')
            ->join('images','blocks.image_id','=','images.id')
            ->where('shares.created_by', '=', $id)
            ->unionAll($first)
            ->get();
        
        return $this->view->make('blocks::wall')->with('blocks',$second);
    }
    
    public function getLoveButton($id)
    {   
        $userId = \Auth::user()->id;
        
        $love = BlockLoves::where('user_id','=',$userId)->where('block_id','=',$id)->get();
        
        $data = array('love'=>$love, 'block'=>$id);
        
        return $this->view->make('blocks::loveButton')->with('love',$data);; 
    }
    
    public function getWallRoute()
    {
        return "blocks";
    }
    
    public function getAddBlockRoute()
    {
        return "blocks/add";
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

