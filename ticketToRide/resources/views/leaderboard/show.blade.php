@extends('layouts.app')

@section('styles')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/2.0.3/css/dataTables.dataTables.min.css">
<style>
    .current-user {
        font-weight: bold;
    }
</style>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">General player ranking</div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="leaderboard-table" class="table table-bordered">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Ranking</th>
                                    <th>Username</th>
                                    <th>Best score</th>
                                </tr>
                            </thead>
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
    var currentUserId = {{ auth()->user()->id_user }}; // Récupérer l'ID de l'utilisateur actuellement authentifié

    $(document).ready(function() {
        $('#leaderboard-table').DataTable({
            ajax:{
                url: "{{ route('getLeaderboard') }}",
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                dataType: 'json',
            },
            columns: [
                { data: null, render: function(data, type, row, meta) { 
                     //return meta.row + 1; 
                    return row.id_user == currentUserId ? '<span class="current-user">' + (meta.row + 1) + '</span>' : (meta.row + 1); 
                } },
                { data: 'username', render: function(data, type, row) { 
                    return row.id_user == currentUserId ? '<span class="current-user">' + data + '</span>' : data; 
                } },
                { data: 'meilleur_score', render: function(data, type, row) { 
                    return row.id_user == currentUserId ? '<span class="current-user">' + data + '</span>' : data; 
                } },
            ],
             order: [[0, 'asc']], // Tri par ranking par défaut
             "columnDefs": [
            { "type": "num", "targets": [0] },
            { "type": "num", "targets": [2]} // Remplacez 0 par l'index de la colonne que vous souhaitez ordonner comme un nombre
        ]
        });
    });
</script>
@endsection
