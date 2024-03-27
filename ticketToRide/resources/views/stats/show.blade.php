@extends('layouts.app')

@section('styles')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/2.0.3/css/dataTables.dataTables.min.css">
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">User Statistics</div>

                <div class="card-body">
                    <p><strong>Username:</strong> {{ $user->username }}</p>
                    <p><strong>Number of games won:</strong> {{ $partiesGagnees }}</p>
                    <p><strong>Number of games lost:</strong> {{ $partiesPerdues }}</p>
                    <p><strong>Total number of games played:</strong> {{ $partiesJouees }}</p>
                    <p><strong>Best score:</strong> {{ $meilleurScore }}</p>

                    <h2>Played Games History:</h2>
                    <div class="table-responsive">
                        <table id="historique-table" class="table table-bordered">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Game Start</th>
                                    <th>Game Duration</th>
                                    <th>Ranking</th>
                                    <th>Score</th>
                                    <th>Other Players</th>
                                    <th>More details</th> 
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
<script src="{{ asset('assets/jquery-3.6.0.min.js') }}"></script>
<script src="https://cdn.datatables.net/2.0.3/js/dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#historique-table').DataTable({
            ajax:{
                url: "{{ route('getHistorique', ['userId' => $user->id_user]) }}",
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                dataType: 'json',
            },  

            columns: [
                { 
                    data: 'start_date',
                    render: function(data) {
                        var date = new Date(data);
                        var options = { year: 'numeric', month: 'short', day: 'numeric'};
                        var formattedDate = date.toLocaleDateString('en-EN', options);
                        return formattedDate + '<br>' + date.toLocaleTimeString('en-EN', {hour: '2-digit', minute: '2-digit'});
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
                        return '<a href="/game/' + data.id_lobby + '" class="btn btn-primary"><i class="bi bi-eye-fill"></i></a>';
                    }
                }
            ]
                
            
        });
    });
</script>

@endsection
