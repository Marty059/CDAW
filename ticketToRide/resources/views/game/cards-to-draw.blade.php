@php
use Illuminate\Support\Facades\Redis;
use App\Models\Wagon;

// Retrieve available wagon card IDs from Redis
$cardsToDraw = Redis::smembers('lobby:'.$lobbyId.':pickable_wagon_card_ids');
$authPlayerId = auth()->user()->id_user;

// Initialize $cardsToPick as an empty array if $cardsToDraw is null
$cardsToPick = [];
if ($cardsToDraw) {
    // Limit to 5 cards
    $cardsToPick = array_slice($cardsToDraw, 0, 5);

    // Map each card ID to its details
    $cardsToPick = array_map(function ($card) {
        $wagon = Wagon::find($card);
        // Check if wagon with the given ID exists
        if ($wagon) {
            return [
                'id_wagon' => $card,
                'colour' => $wagon->colour
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

<div>
    <h3>Train Cards to Draw</h3>
    <ul>
        @foreach($cardsToPick as $card)
            <li>
                {{ $card['colour'] ?? 'Locomotive' }}
                <form action="{{ route('game.pickTrainCard', ['lobbyId' => $lobbyId, 'userId' => $authPlayerId, 'wagonId' => $card['id_wagon']]) }}" method="POST">
                    @csrf
                    <button type="submit">Pick</button>
                </form>
            </li>
        @endforeach
    </ul>
</div>
