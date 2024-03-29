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
<script>
    $(document).ready(function() {
        $('#users-table').DataTable({
            ajax:{
                url: "{{ route('getUsers') }}",
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                dataType: 'json',
            },  

            columns: [
                { data: 'username'},
                { 
                    data: 'email',
                    // render: function(data) {
                    //     return data + ' minutes';
                    // }
                },
                { data: 'country' },
                { data: 'created_at',
                    render: function(data) {
                        var date = new Date(data);
                        var options = { year: 'numeric', month: 'short', day: 'numeric'};
                        var formattedDate = date.toLocaleDateString('en-EN', options);
                        return formattedDate + '<br>' + date.toLocaleTimeString('en-EN', {hour: '2-digit', minute: '2-digit'});
                    }
                },
                { data: null },
                { 
                    data: null,
                    render: function(data, type, row) {
                        return '<a href="/profile/' + data.id_user + '" class="btn btn-primary"><i class="bi bi-eye-fill"></i></a>';
                    }
                }
            ]
                
            
        });
    });
</script>

@endsection
