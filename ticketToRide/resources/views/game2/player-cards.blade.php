@php
// Sample wagon cards data for testing
$wagonCards = [
    ['colour' => 'Red'],
    ['colour' => 'Blue'],
    ['colour' => null],
    ['colour' => 'Green']
];

// Sample destination cards data for testing
$destinationCards = [
    ['city_1' => 'Paris', 'city_2' => 'Berlin'],
    ['city_1' => 'London', 'city_2' => 'Rome']
];
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
