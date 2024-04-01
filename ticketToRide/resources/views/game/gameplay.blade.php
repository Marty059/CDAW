@extends('layouts.app')

@section('content')
<div class="turn"></div>
<div>
<form action="{{ route('game.pickRandomTrainCard', ['lobbyId' => $lobby->id_lobby,'userId' => auth()->user()->id_user]) }}" method="POST">
    @csrf
    <button type="submit">Pick a random train card</button>
</form>
<!-- <form action="{{ route('game.pickDestinationCards', ['lobbyId' => $lobby->id_lobby]) }}" method="POST">
    @csrf
    <button type="submit">Pick 3 destination cards</button>
</form> -->
@if ($lobby->id_createur === auth()->user()->id_user)
<form action="{{route('game.initialize', ['lobbyId' => $lobby->id_lobby])}}" method="POST">
    @csrf
    <button type="submit">Initialize Game</button>
</form>
@endif

@include('game.map')
@include('game.cards-to-draw')
@include('game.player-cards', ['lobbyId' => $lobby->id_lobby])



@endsection

@section('scripts')
<?php $userPairs = $users->pluck('username', 'id_user'); ?>
<script> 
var id_lobby = {{ $lobby->id_lobby }};
var userPairs = {!!json_encode($userPairs) !!};
</script>

<script src="{{ asset('js/game.js') }}"></script>
@endsection
