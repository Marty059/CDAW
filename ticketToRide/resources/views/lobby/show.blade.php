@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{$lobby->name}}</div>
                <div class="card-body">
                    <p><strong>ID:</strong> {{ $lobby->id_lobby }}</p>
                    <p><strong>Max Players:</strong> {{ $lobby->max_players }}</p>
                    <p><strong>Private:</strong> {{ $lobby->is_private ? 'Yes' : 'No' }}</p>
                    <p><strong>Creator ID:</strong> {{ $lobby->id_createur }}</p>
                </div>
                <div class="card-body">
                    <p><strong>Players:</strong></p>
                    <ul class="list-group">
                        @foreach ($users as $user)
                            <li class="list-group-item">
                                <a href="{{ route('profile', ['userId' => $user->id_user]) }}">{{ $user->username }}</a>
                                @if ($lobby->id_createur === auth()->user()->id_user && $user->id_user !== auth()->user()->id_user)
                                    <form action="{{ route('lobby.kick', ['lobby_id' => $lobby->id_lobby, 'player_id' => $user->id_user]) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-sm">Kick</button>
                                    </form>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                </div>
                @php
                $buttonShown = false;
                @endphp

                @foreach ($users as $user)
                    @if ($user->id_user === auth()->user()->id_user)
                        <div class="card-footer text-center">
                            <a class="btn btn-primary" href="{{ route('lobby.leave', ['lobbyId' => $lobby->id_lobby]) }}">Leave</a>
                        </div>
                        @php
                            $buttonShown = true;
                        @endphp
                        @break
                    @endif
                @endforeach

                @if ($lobby->has_started || $lobby->has_ended)
                    <div class="card-footer text-center">
                        <a class="btn btn-primary" href="{{ route('game.showGameplay', ['lobbyId' => $lobby->id_lobby]) }}">View Game</a>
                    </div>
                @else
                    @if (!$buttonShown && count($users) < $lobby->max_players)
                        @if ($lobby->is_private)
                            <div class="card-footer text-center">
                                <form action="{{ route('lobby.join', ['lobbyId' => $lobby->id_lobby]) }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label for="password">Password:</label>
                                        <input type="password" name="password" id="password" class="form-control">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Join</button>
                                </form>
                            </div>
                        @else
                            <div class="card-footer text-center">
                                <a class="btn btn-primary" href="{{ route('lobby.join', ['lobbyId' => $lobby->id_lobby]) }}">Join</a>
                            </div>
                        @endif
                    @endif
                    @if (auth()->user()->id_user === $lobby->id_createur)
                    <div class="card-footer text-center">
                        <form action="{{ route('game.start', ['lobbyId' => $lobby->id_lobby]) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary">Start Game</button>
                        </form>
                    </div>
                    @endif
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script> var id_lobby = {{ $lobby->id_lobby }};</script>
<script src="{{ asset('js/lobby.js') }}"></script>
@endsection