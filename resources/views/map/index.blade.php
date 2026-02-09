<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Hotels Map
        </h2>
        <div id="status" style="margin:10px;font-weight:bold;"></div>

<button id="locateBtn">
    Find My Location
</button>

<div id="map" style="height:500px;"></div>
    </x-slot>

    <div class="p-6">
        <div id="map" style="height: 600px; border-radius: 12px;"></div>
    </div>

    @push('styles')
        <link
            rel="stylesheet"
            href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        />
    @endpush

    @push('scripts')
        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
        <script src="{{ asset('js/map.js') }}"></script>
    @endpush

</x-app-layout>
