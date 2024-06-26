@php
use Illuminate\Support\Facades\Redis;

$authPlayerId = auth()->user()->id_user;

// Récupérer les données des cartes wagon depuis Redis pour le joueur authentifié
$wagonCardsData = Redis::get('lobby:'.$lobbyId.':player:'.$authPlayerId.':wagon_cards');
$wagonCards = json_decode($wagonCardsData, true);

if ($wagonCards === null) {
    $wagonCards = []; 
}

// Récupérer les données des cartes destination depuis Redis pour le joueur authentifié
$destinationCardsData = Redis::get('lobby:'.$lobbyId.':player:'.$authPlayerId.':destination_cards');
$destinationCards = json_decode($destinationCardsData, true);

if ($destinationCards === null) {
    $destinationCards = []; 
}

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

$groupedWagonCards = collect($wagonCards)->groupBy('colour')->map(function($group) {
    return count($group);
});
@endphp

<div class="container-fluid mt-2">
    <div class="row">
        <div class="col-md-4">
            <h3 class="mt-md-0 mt-4">Your Destination Cards</h3>
            <ul class="list-group">
                @foreach($destinationCards as $card)
                    <li class="list-group-item">{{ $card['city_1'] }} to {{ $card['city_2'] }} ({{$card['points']}} points)</li>
                @endforeach
            </ul>
        </div>
        <div class="col">
            <h3>Your Wagon Cards</h3>
            <div class="row mt-2">
            @foreach($groupedWagonCards as $colour => $count)
                <div class="col-md-3 mb-2 pr-md-1 pl-md-1 h-10">
                    <div class="card h-10" style="border: 2px solid {{$colour}};">
                        <div class="card-body text-center">
                            <img src="{{ asset($wagonColorImages[$colour]) }}" alt="{{ $colour }}" class="img-fluid mb-2" style="width: 80px; height: auto;"> <!-- Redimensionner l'image -->
                            <p>({{$count}})</p>
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
        margin-bottom: 0; 
    }

    .col-md-2-5 {
        flex: 0 0 calc(21.5% - 10px); 
        max-width: calc(21.5% - 10px); 
        padding-right: 5px;
        padding-left: 5px; 
        padding-bottom: 5px;
    }
</style>

