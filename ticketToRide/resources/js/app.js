require('./bootstrap');

import Echo from 'laravel-echo'

let e = new Echo({
    broadcaster : 'socket.io',
    host : window.location.hostname + ':6001'
})

e.channel('laravel_database_chan-demo').listen('PostCreatedEvent', function (e) { console.log(e)}) 

$("#demo").click(function (e) {
    e.preventDefault()
    $.get('/post')
})

$("#second").click(function (e) {
    e.preventDefault()
    $.get('/post2')
})