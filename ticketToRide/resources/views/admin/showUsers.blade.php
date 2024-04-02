@extends('layouts.app')

@section('styles')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/2.0.3/css/dataTables.dataTables.min.css">
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                    <div class="card-header">All Users</div>
                

                <div class="card-body">                
                    <div class="table-responsive">
                        <table id="users-table" class="table table-bordered">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Country</th>
                                    <th>Account creation date</th>
                                    <th>Is banned</th>
                                    <th>Ban / Unban</th>
                                    <th>About the player</th> 
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
<script> var baseUrl = <?php echo json_encode(url('/')); ?>; </script>
<script type="text/javascript" src="{{asset('js/admin.js')}}"></script>


@endsection
