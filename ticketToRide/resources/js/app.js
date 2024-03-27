/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import Echo from 'laravel-echo';

if (typeof id_lobby !== 'undefined') {
    window.Echo.join(`lobby.${id_lobby}`)
        .listen('LobbyJoinedEvent', (e) => {
            console.log(e);
        });
}
