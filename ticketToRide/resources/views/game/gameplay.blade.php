@extends('layouts.app')

@section('content')
<button onclick="pickRandomTrainCard()">Pick a random train card</button>
<button onclick="pickRandomDestinations()">Pick 3 random destinations</button>
@yield('map')
@yield('cards-to-draw')
@yield('player-cards')


@endsection

@section('scripts')
<script> var id_lobby = {{ $lobby->id_lobby }};</script>
<script src="{{ asset('js/game.js') }}"></script>
@endsection
