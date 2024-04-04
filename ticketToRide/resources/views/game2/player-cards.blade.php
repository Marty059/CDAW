@extends('layouts.app')

@php
// Exemple de données pour les cartes de wagons
$wagonCardsTestData = [
    ['colour' => 'Red'],
    ['colour' => 'Red'],
    ['colour' => 'Green'],
    ['colour' => null], // Locomotive
    ['colour' => null],
    ['colour' => 'Blue'],
    ['colour' => 'Black'],
    ['colour' => 'White'],
    ['colour' => 'Orange'],
    ['colour' => 'Pink'],
    ['colour' => 'Green'],
    ['colour' => 'Yellow'],
    ['colour' => 'Blue'],
    ['colour' => 'Black'],
    ['colour' => 'White'],
    ['colour' => 'Orange'],
    ['colour' => 'Pink'],
    ['colour' => 'Green'],
    ['colour' => 'Yellow'],
    ['colour' => 'Blue'],
    ['colour' => 'Black'],
    ['colour' => 'White'],
    ['colour' => 'Orange'],
    ['colour' => 'Pink'],
    ['colour' => 'Green'],
    ['colour' => 'Yellow'],
    ['colour' => 'Blue'],
    ['colour' => 'Black'],
    ['colour' => 'White'],
    ['colour' => 'Orange'],
    ['colour' => 'Pink'],
    ['colour' => 'Green'],
    ['colour' => 'Yellow'],
    ['colour' => 'Blue'],
    ['colour' => 'Black'],
    ['colour' => 'White'],
    ['colour' => 'Orange'],
    ['colour' => 'Pink'],
    ['colour' => 'Green'],
    ['colour' => 'Yellow'],
    ['colour' => 'Blue'],
    ['colour' => 'Black'],
    ['colour' => 'White'],
    ['colour' => 'Orange'],
    ['colour' => 'Pink'],
    ['colour' => 'Green'],
    ['colour' => 'Yellow'],
    ['colour' => 'Blue'],
    ['colour' => 'Black'],
    ['colour' => 'White'],
    ['colour' => 'Orange'],
    ['colour' => 'Pink'],
    ['colour' => 'Green'],
    ['colour' => 'Yellow'],
    ['colour' => 'Blue'],
    ['colour' => 'Black'],
    ['colour' => 'White'],
    ['colour' => 'Orange'],
    ['colour' => 'Pink'],
    ['colour' => 'Green'],
    ['colour' => 'Yellow'],
    ['colour' => 'Blue'],
    ['colour' => 'Black'],
    ['colour' => 'White'],
    ['colour' => 'Orange'],
    ['colour' => 'Pink'],
    ['colour' => 'Green'],
    
];

// Exemple de données pour les cartes de destination
$destinationCardsTestData = [
    ['city_1' => 'City A', 'city_2' => 'City B', 'points' => 10],
    ['city_1' => 'City C', 'city_2' => 'City D', 'points' => 15],
    ['city_1' => 'City E', 'city_2' => 'City F', 'points' => 8],
];

// Vous pouvez remplacer les tableaux ci-dessus par vos vraies données Redis une fois que vous réintégrez Redis.

// Utilisez les données de test si Redis n'est pas disponible
$wagonCards = $wagonCardsTestData;
$destinationCards = $destinationCardsTestData;

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

// Regrouper les cartes de wagons par couleur et compter leur nombre
$groupedWagonCards = collect($wagonCards)->groupBy('colour')->map(function($group) {
    return count($group);
});

@endphp

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <h3 class="mt-md-0 mt-4">Your Destination Cards</h3>
            <ul class="list-group">
                @foreach($destinationCards as $card)
                    <li class="list-group-item">{{ $card['city_1'] }} to {{ $card['city_2'] }} ({{$card['points']}} points)</li>
                @endforeach
            </ul>
        </div>
        <div class="col-md-6">
            <h3>Your Wagon Cards</h3>
            <div class="row mt-2">
            @foreach($groupedWagonCards as $colour => $count)
                <div class="col-md-2-5 mb-2 pr-md-1 pl-md-1 h-10">
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
        margin-bottom: 0; /* Remove bottom margin */
    }

    /* Définition d'une nouvelle classe pour une colonne personnalisée */
    .col-md-2-5 {
        flex: 0 0 calc(21.5% - 10px); /* Ajuster la largeur selon vos besoins */
        max-width: calc(21.5% - 10px); /* Ajuster la largeur selon vos besoins */
        padding-right: 5px;
        padding-left: 5px; 
        padding-bottom: 5px;
    }
</style>
</style>
@endsection