<?php 

Route::get(' /love/{id}/{target}','Nijibelle\Loves\LovesController@postLove');
Route::get('/unlove/{id}/{target}','Nijibelle\Loves\LovesController@postUnLove');