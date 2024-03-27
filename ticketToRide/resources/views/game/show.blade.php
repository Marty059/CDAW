@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Lobby Information</h1>
    <div class="row">
        <div class="col-md-6">
            <p><strong>Lobby Name:</strong> {{ $lobby->name }}</p>
            <p><strong>Maximum Number of Players:</strong> {{ $lobby->max_players }}</p>
            <p><strong>Creation Date:</strong> {{ $lobby->creation_date }}</p>
        </div>
    </div>

    <h2>Player Rankings</h2>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Player Name</th>
                    <th scope="col">Ranking</th>
                    <th scope="col">Score</th>
                </tr>
            </thead>
            <tbody>
                @foreach($players as $player)
                <tr>
                    <td>{{ $player->username }}</td>
                    <td>{{ $player->classement }}</td>
                    <td>{{ $player->score }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
