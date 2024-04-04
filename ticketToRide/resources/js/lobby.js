import Echo from 'laravel-echo';


window.Echo = new Echo({
    broadcaster: 'socket.io', 
    host: window.location.hostname + ':6001'
});

window.Echo.join(`lobby.${id_lobby}`).listen('GameLaunchedEvent', function (e) {
    const lobbyId = e.id_lobby;
    window.location.href = `/game/${lobbyId}`;
});