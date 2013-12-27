<?php

Route::get('/u/{username}', 'Nijibelle\Users\UsersController@getProfile');

Route::controller('/user','Nijibelle\Users\UsersController');

Route::controller('/auth','Nijibelle\Users\AuthenticationController');

Route::controller('/social','Nijibelle\Users\SocialAuthController');

Route::controller('/profile','Nijibelle\Users\ProfileController');

Route::controller('/registration','Nijibelle\Users\RegistrationController');

Route::filter('loginRequired', function()
{
   if (\Auth::guest()) return Redirect::guest(Config::get('users::route').'/login');
});

Route::filter('afterLogin', function()
{
   if (\Auth::check()) return Redirect::guest(Config::get('users::route').'/');
});
