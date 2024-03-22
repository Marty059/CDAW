@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Statistiques de l'utilisateur</div>

                <div class="card-body">
                    <p><strong>Nom d'utilisateur :</strong> {{ $user->username }}</p>
                    <p><strong>Nombre de parties gagnées :</strong> {{ $partiesGagnees }}</p>
                    <p><strong>Nombre de parties perdues :</strong> {{ $partiesPerdues }}</p>
                    <p><strong>Nombre total de parties jouées :</strong> {{ $partiesJouees }}</p>
                    <p><strong>Meilleur score :</strong> {{ $meilleurScore }}</p>

                    <h2>Historique des parties jouées :</h2>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Score</th>
                                    <th>Classement</th>
                                    <th>Date de création</th>
                                    <th>Durée de la partie</th>
                                    <!-- Ajoutez d'autres en-têtes de colonnes au besoin -->
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($user->historiquePartiesJouees as $partie)
                                <tr>
                                    <td>{{ $partie->score }}</td>
                                    <td>{{ $partie->classement }}</td>
                                    <td>{{ $partie->lobby->creation_date }}</td>
                                    <td>{{ $partie->lobby->duration }} minutes</td>
                                    <!-- Ajoutez d'autres colonnes avec les informations supplémentaires ici -->
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

