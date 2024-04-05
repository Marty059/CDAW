@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h1 class="mb-0">Game Information</h1>
                </div>
                <div class="card-body">
                    <p><strong>Lobby Name:</strong> {{ $lobby->name }}</p>
                    <p><strong>Number of Players:</strong> {{ count($players) }}</p>
                    <p><strong>Start of the game:</strong> {{ $lobby->creation_date->format('F j, Y') }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center mt-4">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h2 class="mb-0">Players' Ranking</h2>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped mb-0">
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
                                    <td><a href="{{ route('profile', ['userId' => $player->id_user]) }}">{{ $player->username }}</a></td>
                                    <td>{{ $player->classement }}</td>
                                    <td>{{ $player->score }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
