@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <strong>Search</strong>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        @foreach($lobbies as $lobby)
                        <li class="list-group-item">
                            <a href="{{ route('show', ['lobby_id' => $lobby->id_lobby]) }}" class="text-decoration-none">
                                {{$lobby->name}}
                            </a>
                            
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
