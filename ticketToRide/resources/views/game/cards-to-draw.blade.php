@php
use Illuminate\Support\Facades\Redis;
use App\Models\Wagon;

// Retrieve available wagon card IDs from Redis
$cardsToDraw = Redis::smembers('lobby:'.$lobbyId.':pickable_wagon_card_ids');
$authPlayerId = auth()->user()->id_user;
$wagonColorImages = [
    'Black' => 'img/Black.jpeg', 
    'White' => 'img/White.jpeg',
];

// Initialize $cardsToPick as an empty array if $cardsToDraw is null
$cardsToPick = [];
if ($cardsToDraw) {
    // Limit to 5 cards
    $cardsToPick = array_slice($cardsToDraw, 0, 5);

    // Map each card ID to its details
    $cardsToPick = array_map(function ($card) {
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

<div class="container">
    <h3 class="mt-5">Train Cards to Draw</h3>
    <div class="row mt-3">
        @foreach($cardsToPick as $card)
            <div class="col-md-2 mb-3">
                <div class="card">
                    <div class="card-body text-center">
                        @if(isset($card['image']))
                            <img src="{{ asset($card['image']) }}" alt="{{ $card['colour'] }}" class="img-fluid mb-2" style="max-height: 100px;">
                        @endif
                        <p class="card-text">{{ $card['colour'] ?? 'Locomotive' }}</p>
                        <form action="#" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary" disabled>Pick</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
