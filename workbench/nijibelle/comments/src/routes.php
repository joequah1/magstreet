<?php
Route::controller('/comments','Nijibelle\Comments\CommentsController');

Route::get('/comments/realtime/{id}/{block}/{from}','Nijibelle\Comments\CommentsController@getRealTime');
