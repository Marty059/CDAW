import Echo from 'laravel-echo';


// import { io } from 'socket.io-client'; // Replace the unused import statement for 'pusher-js' package with the necessary import statement for 'socket.io' package
window.Echo = new Echo({
    broadcaster: 'socket.io', // Change the broadcaster to 'socket.io'
    // client: io, // Set the client to 'io' from 'socket.io-client'
    host: window.location.hostname + ':6001', // Set the host to the appropriate value
    logLevel: 'debug'
});

window.Echo.join(`lobby.${id_lobby}`)
    .listen('GameLaunchedEvent', function (e) {
    console.log('GameLaunchedEvent', e);
    const lobbyId = e.id_lobby;
    window.location.href = `/game/${lobbyId}`;
})
.listen('TurnChangedEvent', function (e) {
    window.location.reload();
})

// window.addEventListener('load', function() {
//     setTimeout(function() {
//         const lobbyId = window.location.href.split('/').pop();
//         const yourTurnDiv = document.querySelector('.your-turn');
//         if (yourTurnDiv) {
//             fetch(`/game/passTurn/${lobbyId}`, {
//                 method: 'POST',
//                 headers: {
//                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//                 }
//             });
//         }
//     }, 15000); // 1 minute = 60,000 milliseconds
// });

