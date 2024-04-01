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
@endphp

<div>
    <h3>Your Wagon Cards</h3>
    <ul>
        @foreach($wagonCards as $card)
            @if ($card['colour'] === null)
                <li>Locomotive</li>
            @else
                <li>{{ $card['colour'] }}</li>
            @endif
        @endforeach
    </ul>

    <h3>Your Destination Cards</h3>
    <ul>
        @foreach($destinationCards as $card)
            <li>{{ $card['city_1'] }} to {{ $card['city_2'] }}</li>
        @endforeach
    </ul>
</div>
