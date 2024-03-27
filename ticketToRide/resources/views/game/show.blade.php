@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Informations sur le lobby</h1>
    <div class="row">
        <div class="col-md-6">
            <p><strong>Nom du lobby :</strong> {{ $lobby->name }}</p>
            <p><strong>Nombre maximal de joueurs :</strong> {{ $lobby->max_players }}</p>
            <p><strong>Date de création :</strong> {{ $lobby->creation_date }}</p>
        </div>
    </div>

    <h2>Classement des joueurs</h2>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Nom du joueur</th>
                    <th scope="col">Classement</th>
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
