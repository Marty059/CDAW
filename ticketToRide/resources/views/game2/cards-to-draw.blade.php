@extends('layouts.app')

@php
use App\Models\Wagon;

// Tableau de test pour les cartes de wagon
$testWagonCardIds = [1, 2, 3, 74, 73]; 

// Tableau de correspondance entre la couleur et le chemin de l'image
$wagonColorImages = [
    'Black' => 'img/Black.png', 
    'White' => 'img/White.png',
    'Red' => 'img/Red.png',
    'Blue' => 'img/Blue.png',
    'Green' => 'img/Green.png',
];

// Simulation des données provenant de Redis
$cardsToDraw = $testWagonCardIds;
$authPlayerId = auth()->user()->id_user;

// Initialiser $cardsToPick comme un tableau vide si $cardsToDraw est null
$cardsToPick = [];
if ($cardsToDraw) {
    // Limiter à 5 cartes
    $cardsToPick = array_slice($cardsToDraw, 0, 5);

    // Mapper chaque ID de carte vers ses détails
    $cardsToPick = array_map(function ($card) use ($wagonColorImages) {
        $wagon = Wagon::find($card);
        // Vérifier si le wagon avec l'ID donné existe
        if ($wagon && isset($wagonColorImages[$wagon->colour])) {
            return [
                'id_wagon' => $card,
                'colour' => $wagon->colour,
                'image' => $wagonColorImages[$wagon->colour]
            ];
        } else {
            // Gérer le cas où le wagon avec l'ID donné n'est pas trouvé ou que l'image n'est pas définie
            return null;
        }
    }, $cardsToPick);
    // Filtrer les valeurs nulles (wagons non trouvés ou images non définies)
    $cardsToPick = array_filter($cardsToPick);
}
@endphp

@section('content')
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
@endsection
