<?php

return array(

	/*
	|--------------------------------------------------------------------------
	| Routing array
	|--------------------------------------------------------------------------
	|
	| This is passed to the Route::group and allows us to group and filter the
	| routes for our package
	|
	*/
	'routing' => array(
		'prefix' => '/social'
	),

	/*
	|--------------------------------------------------------------------------
	| facebook array
	|--------------------------------------------------------------------------
	|
	| Login and request things from facebook.
	|
	*/
	'facebook' => array(
		'key' => '174896632589031',
		'secret' => '0c97df7870165f045dae57d63ea54291',
		'scopes' => array('email,user_birthday'),
		'redirect_url' => '/user/facebook',
	),

	/*
	|--------------------------------------------------------------------------
	| twitter array
	|--------------------------------------------------------------------------
	|
	| Login and request things from twitter
	|
	*/
	'twitter' => array(
		'key' => 'zEy5IzyPDw3VRSVASDPccA',
		'secret' => 'zTD3zkSruGrGAXGcgK8IKwGEcUxYAt6YGRenS6Stkg',
		'scopes' => array(),
		'redirect_url' => '/user',
	),

	/*
	|--------------------------------------------------------------------------
	| google array
	|--------------------------------------------------------------------------
	|
	| Login and request things from google
	|
	*/
	'google' => array(
		'key' => '127487164734-8kcljejnldjr81dldqr06adps4ivuhcc.apps.googleusercontent.com',
		'secret' => '_k5nZ8jlxcfPmUf4w9MbRDPV',
		'scopes' => array('https://www.googleapis.com/auth/plus.login',
                     'https://www.googleapis.com/auth/userinfo.email'),
		'redirect_url' => '/',
	),
	
	/*
	|--------------------------------------------------------------------------
	| github array
	|--------------------------------------------------------------------------
	|
	| Login and request things from github
	|
	*/
	'github' => array(
		'key' => '',
		'secret' => '',
		'scopes' => array(),
		'redirect_url' => '/',
	),

);
