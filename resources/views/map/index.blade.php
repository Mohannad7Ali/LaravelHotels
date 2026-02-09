<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Hotels Map
        </h2>
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
