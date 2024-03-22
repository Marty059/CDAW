@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Lobby Details</div>
                <div class="panel-body">
                    <p><strong>ID:</strong> {{ $lobby->id_lobby }}</p>
                    <p><strong>Max Players:</strong> {{ $lobby->max_players }}</p>
                    <p><strong>Is Private:</strong> {{ $lobby->is_private ? 'Yes' : 'No' }}</p>
                    <p><strong>Has Started:</strong> {{ $lobby->has_started ? 'Yes' : 'No' }}</p>
                    <p><strong>Has Ended:</strong> {{ $lobby->has_ended ? 'Yes' : 'No' }}</p>
                    <p><strong>Creation Date:</strong> {{ $lobby->creation_date }}</p>
                    <p><strong>Start Date:</strong> {{ $lobby->start_date }}</p>
                    <p><strong>Duration:</strong> {{ $lobby->duration }}</p>
                    <p><strong>Creator ID:</strong> {{ $lobby->id_createur }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
