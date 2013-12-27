<?php

	return array(

		'enabled' => true,

		'route' => 'user',

		'layout' => array(
			'set' => true,
			'name' => 'layouts.main',

		),

		'social' => array(

			'facebook' => array(
				'status' => 'true',
				'href' => "Social::login('facebook')",	
				'img' => 'http://groupinion.com/wp-content/themes/groupinion/images/facebook-login-button.png',	
			),

			'google' => array(
				'status' => 'true',
				'href' => '<?= Social::login("google") ?>',		
				'img' => 'https://developers.google.com/accounts/images/sign-in-with-google.png',	
			),
		),

	);
