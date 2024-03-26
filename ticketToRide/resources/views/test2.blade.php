@extends('layouts.app')

@section('styles')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/2.0.3/css/dataTables.dataTables.min.css">
@endsection

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
                        <table id="historique-table" class="table table-bordered">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Score</th>
                                    <th>Classement</th>
                                    <th>Date de création</th>
                                    <th>Durée de la partie</th>
                                    <th>Autres joueurs</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Les données seront insérées ici via JavaScript -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/2.0.3/js/dataTables.min.js"></script>
<script>
   $(document).ready(function() {
    $.ajax({
        url: "{{ route('getHistorique', ['userId' => $user->id_user]) }}",
        type: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        dataType: 'json',
        success: function(response) {
            console.log(response.data);
            $('#historique-table').DataTable({
                data: response.data,
                columns: [
                    { data: 'score' },
                    { data: 'classement' },
                    { data: 'creation_date' }, // Assurez-vous que la clé correspond à la propriété dans votre modèle
                    { data: 'duration' }, // Assurez-vous que la clé correspond à la propriété dans votre modèle
                    { data: 'joueurs' } // Assurez-vous d'adapter cette colonne selon votre structure de données
                ]
            });
        }
    });
});

</script>
@endsection

