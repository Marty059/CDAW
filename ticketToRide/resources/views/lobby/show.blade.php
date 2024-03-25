@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Lobby Details</div>
                <div class="panel-body">
                    <p><strong>ID:</strong> {{ $lobby->id_lobby }}</p>
                    <p><strong>Max Players:</strong> {{ $lobby->max_players }}</p>
                    <p><strong>Private:</strong> {{ $lobby->is_private ? 'Yes' : 'No' }}</p>
                    <p><strong>Creation Date:</strong> {{ $lobby->creation_date }}</p>
                    <p><strong>Creator ID:</strong> {{ $lobby->id_createur }}</p>
                </div>
                <div class="panel-body">
                    <p><strong>Players:</strong></p>
                    <ul>
                        @foreach ($users as $user)
                            <li ><a href="{{route('profile', ['userId' => $user->id_user])}}">{{ $user->username}}</a></li>
                        @endforeach
                    </ul>
                </div>
                <button><a href="{{ route('lobby.join', ['lobbyId' => $lobby->id_lobby]) }}">Join</a></button>
            </div>
        </div>
    </div>
</div>
@endsection
