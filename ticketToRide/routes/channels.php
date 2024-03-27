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


Broadcast::channel('lobby.{lobbyId}', function ($user, $lobbyId) {
    if (App\Models\Lobby::find($lobbyId)->getUsers()->pluck('id_user')->contains($user->id_user)){
        return ['id_user' => $user->id_user, 'username' => $user->username];
    };
});