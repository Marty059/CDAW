@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @foreach($lobbies as $lobby)
        <div class="col-sm-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <strong>Search</strong>
                </div>
                <div class="panel-body">
                    <ul class="list-lobby">
                        @foreach($lobbies as $lobby)
                        <li class="list-lobby-item">
                            <a href="{{ route('lobby', ['lobby_id' => $lobby->id_lobby]) }}">Lobby {{$lobby->id_lobby}}</a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
