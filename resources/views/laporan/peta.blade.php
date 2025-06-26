@extends('layouts.index')

@section('content')
<h2 class="text-xl font-bold mb-4 capitalize">Laporan Peta</h2>

<div class="bg-white shadow p-4 rounded">
    <div id="map" style="height: 650px;"></div>
</div>
@endsection
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const polygonCoords = [
            [-3.4751, 114.8433],
            [-3.4763, 114.8391],
            [-3.4736, 114.8334],
            [-3.4673, 114.8341],
            [-3.4644, 114.8365],
            [-3.4544, 114.8368],
            [-3.4457, 114.828],
            [-3.4407, 114.8431],
            [-3.4413, 114.8737],
            [-3.4435, 114.8778],
            [-3.4508, 114.8772],
            [-3.4586, 114.8795],
            [-3.4613, 114.8833],
            [-3.4639, 114.8827],
            [-3.466, 114.8595],
            [-3.4686, 114.8566],
            [-3.4692, 114.8512],
            [-3.473, 114.848],
            [-3.4751, 114.8433]
        ];

        const centerBanjarbaru = [-3.4593217, 114.8002246];

        const map = L.map('map').setView(centerBanjarbaru, 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        L.polygon(polygonCoords, {
            color: 'blue',
            fillColor: '#3f93ff',
            fillOpacity: 0.4
        }).addTo(map).bindPopup('Wilayah Polygon');

    });
</script>

@section('scripts')

@endsection