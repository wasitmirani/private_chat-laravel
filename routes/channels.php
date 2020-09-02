<?php

use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('users', function ($user) {
    return $user;
});
Broadcast::channel('test-channel', function ($user) {
    return true;
});


Broadcast::channel('privatechat.{receiver_id}', function ($user,$receiver_id) {

    return auth()->check();
});
