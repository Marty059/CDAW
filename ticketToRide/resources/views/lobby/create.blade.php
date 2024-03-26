@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Create Lobby</h1>
        <form action="{{ route('lobby.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Lobby Name</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="max_players">Max Players</label>
                <select name="max_players" id="max_players" class="form-control" required>
                    <option value="2">2 Players</option>
                    <option value="3">3 Players</option>
                    <option value="4">4 Players</option>
                    <option value="5">5 Players</option>
                </select>
            </div>
            <div class="form-group">
                <label for="is_private">Private Lobby</label>
                <input type="checkbox" name="is_private" id="is_private" class="form-control">
            </div>
            <div class="form-group">
                <label for="password">Lobby Password</label>
                <input type="password" name="password" id="password" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Create</button>
        </form>
    </div>
@endsection