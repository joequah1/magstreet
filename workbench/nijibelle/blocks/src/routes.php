<?php

Route::controller('/blocks','Nijibelle\Blocks\BlocksController');

Route::get('/block/love/{id}','Nijibelle\Blocks\LoveController@postLove');
Route::get('/block/unlove/{id}','Nijibelle\Blocks\LoveController@postUnLove');

ROute::get('/block/get/{id}/{comment_table_from}/{comment_target_id?}','Nijibelle\Blocks\BlocksController@getBlock');