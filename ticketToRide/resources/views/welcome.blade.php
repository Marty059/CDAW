@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="jumbotron text-center">
                <h1>Welcome to Ticket To Ride Online!</h1>
                <p>Play the popular board game online and compete against a large community of players.</p>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 text-center">
            <img src="{{ asset('img/Map.png') }}" alt="Ticket to Ride Map" class="img-fluid reduce-size">
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-md-12">
            <h2>About Ticket To Ride Online</h2>
            <p>Experience the excitement of playing the popular board game Ticket To Ride online. Connect cities, build routes, and compete against a large community of players from around the world.</p>
            <p>Learn the rules of the game:</p>
            <ul>
                <li>Players collect train cards to claim railway routes across the map.</li>
                <li>Complete routes to earn points and achieve victory.</li>
                <li>Strategize to block opponents and optimize your own routes.</li>
                <li>Score bonus points for longest continuous routes and completed destination tickets.</li>
            </ul>
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-md-4">
            <img src="{{ asset('img/Locomotive.png') }}" alt="Locomotive" class="img-fluid">
        </div>
        <div class="col-md-4">
            <img src="{{ asset('img/Blue.png') }}" alt="Blue" class="img-fluid">
        </div>
        <div class="col-md-4">
            <img src="{{ asset('img/Pink.png') }}" alt="Pink" class="img-fluid">
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-md-6">
            <h3>How to Play</h3>
            <p>Learn how to play Ticket To Ride Online and start your journey to become a master strategist.</p>
            <a href="#" class="btn btn-primary">Learn More</a>
        </div>
        <div class="col-md-6">
            <h3>Join the Community</h3>
            <p>Connect with other players, join tournaments, and participate in exciting events.</p>
            <a href="#" class="btn btn-primary">Join Now</a>
        </div>
    </div>
</div>

<style>
    .reduce-size {
        max-width: 60%;
        height: auto;
    }
</style>
@endsection
