@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <strong>Browser</strong>
                    <a href="{{ route('lobby.create') }}" class="btn btn-primary">Create</a>
                </div>
                <div class="card-body">
                    <form action="{{ route('lobby.search') }}" method="GET">
                        <div class="input-group mb-3">
                            <input type="text" name="name" class="form-control" placeholder="Search by lobby name">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="submit">Search</button>
                            </div>
                        </div>
                    </form>
                    <ul class="list-group">
                        @foreach($lobbies as $lobby)
                        <li class="list-group-item">
                            <a href="{{ route('show', ['lobby_id' => $lobby->id_lobby]) }}" class="text-decoration-none">
                                {{$lobby->name}}
                            </a>
                        </li>
                        @endforeach
                    </ul>
                    <div class="mt-3">
                        <nav aria-label="Page navigation">
                            <ul class="pagination">
                                {{ $lobbies->links() }} <!-- Pagination links -->
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
svg {
    width: 0.75rem;
    height: 0.75rem;
}
</style>
@endsection
