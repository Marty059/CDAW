@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Informations sur le lobby</h1>
    <p>Nom du lobby : {{ $lobby->name }}</p>
    <p>Nombre maximal de joueurs : {{ $lobby->max_players }}</p>
    <p>Date de création : {{ $lobby->creation_date }}</p>

    <h2>Classement des joueurs</h2>
    <table>
        <thead>
            <tr>
                <th>Nom du joueur</th>
                <th>Classement</th>
                <th>Score</th>
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
@endsection
