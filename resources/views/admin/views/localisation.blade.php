@extends('admin.base')
@section('title', 'Localisation')
@section('content')

{{-- CDN Mapbox --}}
<script src='https://api.mapbox.com/mapbox-gl-js/v2.14.1/mapbox-gl.js'></script>
<link href='https://api.mapbox.com/mapbox-gl-js/v2.14.1/mapbox-gl.css' rel='stylesheet' />
{{-- CDN Mapbox --}}


<div class="container mb-3">
        <form action="{{ route('rechercheLocalisation') }}" method="post" class="vstack gap-3">
            @csrf
            <div class="row">
                <div class="form-group">
                    <label for="chauffeur">Chauffeur</label>
                    <select name="chauffeur_id" id="chauffeur" class="form-control">
                        <option>Selectionner un chauffeur</option>
                        @if (!empty($chauffeurs))
                        @foreach ($chauffeurs as $chauffeur)
                        <option value="{{ $chauffeur->id }}">{{ $chauffeur->nom }}</option>
                    @endforeach
                        @endif

                    </select>
                    @error('chauffeur_id')
                        {{ $message }}
                    @enderror
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <label for="de">De</label>
                    <input type="date" name="de" id="de" class="form-control">
                    @error('de')
                        {{ $message }}
                    @enderror
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <label for="a">A</label>
                    <input type="date" name="a" id="a" class="form-control">
                    @error('a')
                        {{ $message }}
                    @enderror
                </div>
            </div>
            <div>
                <button class="btn btn-primary">Rechercher</button>
            </div>
        </form>
    </div>
</div>

<div id='map' style='width: 1500px; height: 550px;'></div>



<script>
mapboxgl.accessToken = 'pk.eyJ1IjoieW9uZGFpbmUiLCJhIjoiY2xuYmhrYWlrMGUwYTJscWtzNTRrcDR1MiJ9.4arIoY8-wIwjDJOJ6zx9uQ';

@if (!empty($localisations))


// Données de localisation
const localisations = @json($localisations);


localisations.forEach(element => {
    console.log([element.longitude, element.latitude]);
});


// Création de la carte
const map = new mapboxgl.Map({
    container: 'map',
    style: 'mapbox://styles/mapbox/streets-v12',
    center: [localisations[60].longitude, localisations[60].latitude],
    zoom: 14,
});


// Ajout des marqueurs
localisations.forEach(localisation => {
    new mapboxgl.Marker({ color: "#0000FF", draggable: false })
        .setLngLat([localisation.longitude, localisation.latitude])
        .addTo(map);
});


// Création de la ligne reliant les marqueurs
map.on('load', () => {
    map.addSource('route', {
        type: 'geojson',
        data: {
            type: 'Feature',
            properties: {},
            geometry: {
                type: 'LineString',
                coordinates: localisations.map(localisation => [localisation.longitude, localisation.latitude]),
            },
        },
    });

    map.addLayer({
        id: 'route',
        type: 'line',
        source: 'route',
        layout: {
            'line-join': 'round',
            'line-cap': 'round',
        },
        paint: {
            'line-color': '#888',
            'line-width': 8,
        },
    });
});
@endif
</script>

@endsection
