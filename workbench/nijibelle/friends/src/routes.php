<?php

Route::get('friends/add/{id}/{friend_id}', 'Nijibelle\Friends\FriendController@postAddFriend');

Route::get('friends/list/{id}', 'Nijibelle\Friends\FriendController@getFriendList');