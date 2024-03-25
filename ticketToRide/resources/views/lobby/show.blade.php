@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Lobby Details</div>
                <div class="card-body">
                    <p><strong>ID:</strong> {{ $lobby->id_lobby }}</p>
                    <p><strong>Max Players:</strong> {{ $lobby->max_players }}</p>
                    <p><strong>Private:</strong> {{ $lobby->is_private ? 'Yes' : 'No' }}</p>
                    <p><strong>Creation Date:</strong> {{ $lobby->creation_date }}</p>
                    <p><strong>Creator ID:</strong> {{ $lobby->id_createur }}</p>
                </div>
                <div class="card-body">
                    <p><strong>Players:</strong></p>
                    <ul class="list-group">
                        @foreach ($users as $user)
                            <li class="list-group-item"><a href="{{ route('profile', ['userId' => $user->id_user]) }}">{{ $user->username }}</a></li>
                        @endforeach
                    </ul>
                </div>
                <div class="card-footer text-center">
                    <a class="btn btn-primary" href="{{ route('lobby.join', ['lobbyId' => $lobby->id_lobby]) }}">Join</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
