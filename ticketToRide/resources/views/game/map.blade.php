@php
$width = 3543*0.16;
$height = 2835*0.16;
@endphp

<div class="d-flex justify-content-center">
    <div class="map">
        <img src="{{ asset('img/Map.png') }}" alt="Map" class="img-fluid" style="width: {{ $width }}px; height: {{ $height }}px;">
    </div>
</div>