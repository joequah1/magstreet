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
            'files'  => true,
            'id' => 'my-awesome-dropzone'
        );

        return $this->view->make('blocks::addBlock')->with('form_options',$form_options);	
    }
    
    public function getWall($id)
	{    
        $first = \DB::table('blocks')
            ->select(\DB::raw(" 'blocks' as tablename, blocks.id as id, null as share, blocks.caption as caption, images.path as path, users.firstname as firstname, users.lastname as lastname, blocks.category_id as category_id, blocks.created_at as created_at, users.id as userid, null as source"))
            
             ->join('users','blocks.created_by','=','users.id')
             ->join('images','blocks.image_id','=','images.id')
             ->where('blocks.created_by', '=', $id)
             ->orderBy('created_at','desc');
        
        $second = \DB::table('blocks')
            ->select(\DB::raw(" 'shares' as tablename, blocks.id as id, shares.id as share, shares.caption as caption, images.path as path, users.firstname as firstname, users.lastname as lastname, blocks.category_id as category_id, shares.created_at as created_at, users.id as userid, blocks.created_by as source"))
            ->join('share_blocks','share_blocks.block_id','=','blocks.id')
            ->join('shares','share_blocks.share_id','=','shares.id')
            ->join('users','shares.created_by','=','users.id')
            ->join('images','blocks.image_id','=','images.id')
            ->where('shares.created_by', '=', $id)
            ->unionAll($first)
            ->get();
        
        return $this->view->make('blocks::wall')->with('blocks',$second);
    }
    
    
    public function getWallRoute()
    {
        return "blocks";
    }
    
    public function getAddBlockRoute()
    {
        return "blocks/add";
    }
    
    public function getRecommendationImage()
    {
        /****

        * Simple PHP application for using the Bing Search API
        
        */
        $contents ="{RESULTS}";
        
        $acctKey = 'i5TFVynPBrWx2oEVYHFYTRacWSwhcReAkRmGpRtY5v4';
        
        $rootUri = 'https://api.datamarket.azure.com/Bing/Search';
        
        // Read the contents of the .html file into a string.
        
        $query = urlencode("'I'm so happy'");
        
        $serviceOp = 'Image';
        
        $requestUri = "$rootUri/$serviceOp?\$format=json&Query=$query";
        
        $auth = base64_encode("$acctKey:$acctKey");

        $data = array(
        
        'http' => array(
        
        'request_fulluri' => true,
        
        // ignore_errors can help debug – remove for production. This option added in PHP 5.2.10
        
        'ignore_errors' => true,
        
        'header' => "Authorization: Basic $auth")
        
        );
        
        $context = stream_context_create($data);
        
        // Get the response from Bing.
        
        $response = file_get_contents($requestUri, 0, $context);
                
        // Decode the response. 
        $jsonObj = json_decode($response); 
        $resultStr = ''; 
        
        // Parse each result according to its metadata type. 
        foreach($jsonObj->d->results as $value) 
        { 
            $resultStr .= "<h4>{$value->Title} ({$value->Width}x{$value->Height}) " . "{$value->FileSize} bytes)</h4>" . "<a href=\"{$value->MediaUrl}\">" . "<img src=\"{$value->Thumbnail->MediaUrl}\"></a><br />"; 
              
        } 
        
        // Substitute the results placeholder. Ready to go. 
        
        $contents = str_replace('{RESULTS}', $resultStr, $contents);
        
        return $contents;
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

