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
                                    <th>Début de la partie</th>
                                    <th>Durée de la partie</th>
                                    <th>Classement</th>
                                    <th>Score</th>
                                    <th>Autres joueurs</th>
                                    <th>Action</th> 
                                </tr>
                            </thead>
                            <tbody>
                                
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
                    { 
                        data: 'start_date',
                        render: function(data) {
                            // Formater la date au format désiré
                            var date = new Date(data);
                            var options = { year: 'numeric', month: 'short', day: 'numeric' };
                            return date.toLocaleDateString('fr-FR', options);
                        }
                    },
                    { 
                        data: 'duration',
                        render: function(data) {
                            return data + ' minutes';
                        }
                    },
                    { data: 'classement' },
                    { data: 'score' },
                    { data: 'joueurs' },
                    { 
                        data: null,
                        render: function(data, type, row) {
                            return '<a href="/game/' + data.id_lobby + '" class="btn btn-primary">Voir plus de détails</a>';
                        }
                    }
                ]
            });
        }
    });
});
</script>

@endsection
