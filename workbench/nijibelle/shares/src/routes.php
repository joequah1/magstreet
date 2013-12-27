<?php

Route::controller('/shares','Nijibelle\Shares\SharesController');

Route::get('/share/add/{target_share}/{id_share}/{image}','Nijibelle\Shares\SharesController@getAdd');