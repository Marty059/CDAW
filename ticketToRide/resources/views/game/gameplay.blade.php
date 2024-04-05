@extends('layouts.app')

@php
use Illuminate\Support\Facades\Redis;

$turn_id=Redis::get('lobby:'.$lobby->id_lobby.':current_turn');
$available_train_paths=json_decode(Redis::get('lobby:'.$lobby->id_lobby.':available_train_paths'));

@endphp

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-6 border-right"> 
            @include('game.map')
            @include('game.player-cards', ['lobbyId' => $lobby->id_lobby])
        </div>
        <div class="col-md-2 "> 
            @if ($lobby->id_createur === auth()->user()->id_user)
                    <form action="{{ route('game.endGame', ['lobbyId' => $lobby->id_lobby]) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-danger mb-3">End Game</button>
                    </form>
                @endif
            @if($turn_id==auth()->user()->id_user)
                <div class="turn">
                    <div class="your-turn p-2 mb-3 pb-3 border-bottom">It's your turn!</div>
                        <form action="{{ route('game.pickRandomTrainCard', ['lobbyId' => $lobby->id_lobby,'userId' => auth()->user()->id_user]) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary mb-3">Pick a random train card</button>
                        </form>

                        <form action="{{ route('game.pickDestinationCards', ['lobbyId' => $lobby->id_lobby,'userId' => auth()->user()->id_user]) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary mb-3">Pick 3 destination cards</button>
                        </form>

                        @if($available_train_paths)
                        <div class="border-top pt-3 pb-3">
                            <h3 class="mb-3">Available Paths to Lay Trains</h3>
                            <form action="{{ route('game.placeTrainPath',['lobbyId' => $lobby->id_lobby]) }}" method="POST">
                                @csrf
                                <select name="train_path" class="form-control mb-3">
                                    @foreach ($available_train_paths as $path)
                                        <option value="{{ $path->id_path }}">
                                            {{ $path->city_1 }} to {{ $path->city_2 }} : {{ $path->length }} 
                                            @if(!($path->colour)) (Any) 
                                            @else() ({{ $path->colour }})
                                            @endif
                                        </option>
                                    @endforeach
                                </select>
                                <button type="submit" class="btn btn-primary">Lay Train</button>
                            </form>
                        </div>
                        @endif
                        
                </div>

            @endif
            <div class="border-top">
                @include('game.layed-train-paths', ['lobbyId' => $lobby->id_lobby])
            </div>    
        </div>
        <div class="col-md-2"> 
            @if($turn_id==auth()->user()->id_user)
                <div class="turn">
                    @include('game.cards-to-draw', ['lobbyId' => $lobby->id_lobby])
                </div>
            @endif
        </div>
    </div>
</div>





@endsection

@section('scripts')
<?php $userPairs = $users->pluck('username', 'id_user'); ?>
<script> 
var id_lobby = {{ $lobby->id_lobby }};
var userPairs = {!!json_encode($userPairs) !!};
</script>

<script src="{{ asset('js/game.js') }}"></script>
@endsection
