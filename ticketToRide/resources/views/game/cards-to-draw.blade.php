@php
use Illuminate\Support\Facades\Redis;
use App\Models\Wagon;

// Retrieve available wagon card IDs from Redis
$cardsToDraw = Redis::smembers('lobby:'.$lobbyId.':pickable_wagon_card_ids');
$authPlayerId = auth()->user()->id_user;
$wagonColorImages = [
    'Black' => 'img/Black.png', 
    'White' => 'img/White.png',
    'Red' => 'img/Red.png',
    'Blue' => 'img/Blue.png',
    'Green' => 'img/Green.png',
    'Yellow' => 'img/Yellow.png',
    'Orange' => 'img/Orange.png',
    'Pink' => 'img/Pink.png',
    null => 'img/Locomotive.png'
];

// Initialize $cardsToPick as an empty array if $cardsToDraw is null
$cardsToPick = [];
if ($cardsToDraw) {
    // Limit to 5 cards
    $cardsToPick = array_slice($cardsToDraw, 0, 5);

    // Map each card ID to its details
    $cardsToPick = array_map(function ($card) use ($wagonColorImages) {
        $wagon = Wagon::find($card);
        // Check if wagon with the given ID exists
        if ($wagon && isset($wagonColorImages[$wagon->colour])) {
            return [
                'id_wagon' => $card,
                'colour' => $wagon->colour,
                'image' => $wagonColorImages[$wagon->colour]
            ];
        } else {
            // Handle case where wagon with the given ID is not found
            return null;
        }
    }, $cardsToPick);
    // Filter out null values (wagons not found)
    $cardsToPick = array_filter($cardsToPick);
}

@endphp

    <div class="container-fluid">
        <h3>Train Cards to Draw</h3>
        <div class="row d-flex flex-column">
            @foreach($cardsToPick as $card)
                <div class="col mb-2">
                    <div class="card">
                    <div class="card-body d-flex justify-content-center align-items-center">
        @if(isset($card['image']))
        <div class="md-2 text-center">
            <img src="{{ asset($card['image']) }}" alt="{{ $card['colour'] }}" class="img-fluid mb-1" style="max-height: 85px;">
        </div>
        @endif
        <div>
            <form action="{{ route('game.pickTrainCard', ['lobbyId' => $lobbyId, 'userId' => $authPlayerId, 'wagonId' => $card['id_wagon']]) }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-primary">Pick</button>
            </form>
        </div>
    </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

<!-- <style>
.col-md-2-5 {
        flex: 0 0 calc(15.5% - 10px); /* Ajuster la largeur selon vos besoins */
        max-width: calc(15.5% - 10px); /* Ajuster la largeur selon vos besoins */
        padding-right: 5px;
        padding-left: 5px; 
        padding-bottom: 5px;
    }
</style> -->
