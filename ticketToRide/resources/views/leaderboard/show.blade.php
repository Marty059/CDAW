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
                                    <th>About the player</th> 
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
    var baseUrl = <?php echo json_encode(url('/')); ?>; // Récupérer l'URL de base du site
</script>
<script type="text/javascript" src="{{ asset('js/leaderboard.js') }}"></script>
@endsection
