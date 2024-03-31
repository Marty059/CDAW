<?php

use Illuminate\Support\Facades\Broadcast;
use App\Models\Lobby;
use App\Models\Jouer;

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
    // Check if the lobby exists
    $lobby = Lobby::find($lobbyId);
    
    if (!$lobby) {
        return false; // Lobby not found, deny access
    }

    // Check if the user is a member of the lobby
    $isMember = Jouer::where('id_lobby', $lobbyId)
                    ->where('id_user', $user->id_user)
                    ->exists();
    
    if ($isMember) {
        // Return user data if authorized
        return [
            'id_user' => $user->id_user,
            'username' => $user->username
        ];
    }

    return false; // User not authorized, deny access
});