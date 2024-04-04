@php
use Illuminate\Support\Facades\Redis;

// Retrieve the authenticated player's ID
$authPlayerId = auth()->user()->id_user;

// Retrieve the wagon cards data from Redis for the authenticated player
$wagonCardsData = Redis::get('lobby:'.$lobbyId.':player:'.$authPlayerId.':wagon_cards');
$wagonCards = json_decode($wagonCardsData, true);

// Check if wagon cards data exists and is valid
if ($wagonCards === null) {
    $wagonCards = []; // Set it to an empty array if it's null
}

// Retrieve the destination cards data from Redis for the authenticated player
$destinationCardsData = Redis::get('lobby:'.$lobbyId.':player:'.$authPlayerId.':destination_cards');
$destinationCards = json_decode($destinationCardsData, true);

// Check if destination cards data exists and is valid
if ($destinationCards === null) {
    $destinationCards = []; // Set it to an empty array if it's null
}

$wagonColorImages = [
    'Black' => 'img/Black.jpeg', 
    'White' => 'img/White.jpeg',
    'Red' => 'img/Red.jpeg',
    'Blue' => 'img/Blue.jpeg',
    'Green' => 'img/Green.jpeg',
    'Yellow' => 'img/Yellow.jpeg',
    'Orange' => 'img/Orange.jpeg',
    'Pink' => 'img/Pink.jpeg',
    null => 'img/Locomotive.png'
];
@endphp

<div class="container">
    <div class="row">
        <div class="col-md-6">
            <h3 class="mt-md-0 mt-4">Your Destination Cards</h3>
            <ul class="list-group">
                @foreach($destinationCards as $card)
                    <li class="list-group-item">{{ $card['city_1'] }} to {{ $card['city_2'] }} ({{$card['points']}})</li>
                @endforeach
            </ul>
        </div>
        <div class="col-md-6">
            <h3>Your Wagon Cards</h3>
            <div class="row">
                @foreach($wagonCards as $card)
                    <div class="col-md-3 mb-3">
                        <div class="card">
                            <div class="card-body text-center">
                                @if ($card['colour'] === null)
                                    <p>Locomotive</p>
                                @else
                                    <p>{{ $card['colour'] }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        
    </div>
</div>

<style>
    .list-group {
        display: inline-block;
        width: auto;
        max-width: 100%;
        margin-bottom: 0; /* Remove bottom margin */
    }
</style>

