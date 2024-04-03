@extends('layouts.app')

@php
use Illuminate\Support\Facades\Redis;

$turn_id=Redis::get('lobby:'.$lobby->id_lobby.':current_turn');
$available_train_paths=json_decode(Redis::get('lobby:'.$lobby->id_lobby.':available_train_paths'));


//$layed_train_paths=json_decode(Redis::get('lobby:'.$lobby->id_lobby.':player:'.auth()->user()->id_user.':layed_train_paths'));

@endphp

@section('content')

<div class="turn"></div>
@if($turn_id==auth()->user()->id_user)
    <div class="your-turn">It's your turn!</div>

    <form action="{{ route('game.pickRandomTrainCard', ['lobbyId' => $lobby->id_lobby,'userId' => auth()->user()->id_user]) }}" method="POST">
        @csrf
        <button type="submit">Pick a random train card</button>
    </form>

    <form action="{{ route('game.pickDestinationCards', ['lobbyId' => $lobby->id_lobby,'userId' => auth()->user()->id_user]) }}" method="POST">
        @csrf
        <button type="submit">Pick 3 destination cards</button>
    </form>
    @if($available_train_paths)
    <div>
        <h3>Available Paths to Lay Trains</h3>
        <form action="{{ route('game.placeTrainPath',['lobbyId' => $lobby->id_lobby]) }}" method="POST">
            @csrf
            <select name="train_path">
                @foreach ($available_train_paths as $path)
                    <option value="{{ $path->id_path }}">
                    {{ $path->city_1 }} to {{ $path->city_2 }} : {{ $path->length }} 
                    @if(!($path->colour)) (Any) 
                    @else() ({{ $path->colour }})
                    @endif
                </option>
                @endforeach
            </select>
            <button type="submit">Lay Train</button>
        </form>
    </div>
    @endif


@else
    <div class="your-turn">It's not your turn!</div>
@endif
@if ($lobby->id_createur === auth()->user()->id_user)
<form action="{{route('game.initialize', ['lobbyId' => $lobby->id_lobby])}}" method="POST">
    @csrf
    <button type="submit">Initialize Game</button>
</form>
@endif

@include('game.map')
@include('game.cards-to-draw', ['lobbyId' => $lobby->id_lobby])
@include('game.player-cards', ['lobbyId' => $lobby->id_lobby])
@include('game.layed-train-paths', ['lobbyId' => $lobby->id_lobby])

@endsection

@section('scripts')
<?php $userPairs = $users->pluck('username', 'id_user'); ?>
<script> 
var id_lobby = {{ $lobby->id_lobby }};
var userPairs = {!!json_encode($userPairs) !!};
</script>

<script src="{{ asset('js/game.js') }}"></script>
@endsection
