<?php namespace Nijibelle\Blocks;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Config;
use Illuminate\Routing\Controllers\Controller;

use Nijibelle\Users\User;

class BingController extends \BaseController {

    /**
	* Love
	*
	* @return 
	*/
    public function getRecommendationImage($input)
    {
        /****

        * Simple PHP application for using the Bing Search API
        
        */
        
        $contents ="{RESULTS}";
        
        $acctKey = 'i5TFVynPBrWx2oEVYHFYTRacWSwhcReAkRmGpRtY5v4';
        
        $rootUri = 'https://api.datamarket.azure.com/Bing/Search';
        
        // Read the contents of the .html file into a string.
        
        $query = urlencode("'$input'");
        
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
        
        $data = array('images'=>$jsonObj);
        
        return \View::make('blocks::imageRecommendations')->with('data',$data);
        
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
}
