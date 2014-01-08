<?php
Route::controller('/comments','Nijibelle\Comments\CommentsController');

Route::get('/comments/realtime/{offset}/{target_id}/{from}','Nijibelle\Comments\CommentsController@getRealTime');

Route::get('/comments/previouscomments/{offset}/{target_id}/{from}','Nijibelle\Comments\CommentsController@getPreviousComments');
