<?php

Route::get('friends/add/{userId}/{friendId}', 'Nijibelle\Friends\FriendController@postAddFriend');
Route::get('friends/remove/{userId}/{friendId}', 'Nijibelle\Friends\FriendController@postUnFriend');

Route::get('friends/list/{id}', 'Nijibelle\Friends\FriendController@getFriendList');