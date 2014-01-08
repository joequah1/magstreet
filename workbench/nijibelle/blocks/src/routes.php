<?php

Route::controller('/blocks','Nijibelle\Blocks\BlocksController');



Route::get('/block/get/{id}/{comment_table_from}/{comment_target_id?}','Nijibelle\Blocks\BlocksController@getBlock');

Route::get('/bing/image/recommendation/{input}','Nijibelle\Blocks\BingController@getRecommendationImage');