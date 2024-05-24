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

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});



Broadcast::channel('chat', function ($user) {
    if($user != null){
        return [
            'id'    => $user->id,
            'name'  => $user->name
        ];
    }else{
        return false;
    }
});

Broadcast::channel('chat.private.{userSendId}.{userReceiverId}', function ($user,$userSendId,$userReceiverId) {
    if($user != null){
        if($user->id == $userSendId || $user->id == $userReceiverId){
            return true;
        }
    }
    return false;
});
