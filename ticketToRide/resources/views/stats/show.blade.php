@extends('layouts.app')

@section('styles')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/2.0.3/css/dataTables.dataTables.min.css">
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                @if ($user->id_user === auth()->user()->id_user)
                    <div class="card-header">My Statistics</div>
                @else
                    <div class="card-header">{{ $user->username }}'s Statistics</div>
                @endif
                

                <div class="card-body">                
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
<script> var userId = {{$user->id_user}}; 
var baseUrl = <?php echo json_encode(url('/')); ?>;
</script>

<script type="text/javascript" src="{{asset('js/stats.js')}}"></script>


@endsection
