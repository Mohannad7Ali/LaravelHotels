@extends('layouts.app')

@section('title', 'Hotels Map')

@section('navigation')
    @include('layouts.navigation')
@endsection

@section('header')
<h2 class="font-semibold text-xl text-gray-800 leading-tight">Hotels Map</h2>
@endsection

@section('content')
<div class="p-6 space-y-4">

    <!-- Status / Messages -->
    <div id="status" class="font-semibold text-gray-700"></div>

    <!-- Filters -->
    <div class="flex flex-wrap gap-4 mb-4 items-center">
        <select id="filterCity" class="border border-gray-300 rounded px-3 py-2 focus:ring-blue-500 focus:border-blue-500">
            <option value="">Cities</option>
            <option value="Zurich">Zurich</option>
            <option value="Geneva">Geneva</option>
            <option value="Damascus">Damascus</option>
            <option value="Dubai">Dubai</option>
            <option value="Paris">Paris</option>
        </select>

        <select id="filterStars" class="border border-gray-300 rounded px-3 py-2 focus:ring-blue-500 focus:border-blue-500">
            <option value="">Stars   </option>
            <option value="5">5 ⭐</option>
            <option value="4">4 ⭐</option>
            <option value="3">3 ⭐</option>
        </select>

        <input id="searchName" type="text" placeholder="Search hotel..."
            class="border border-gray-300 rounded px-3 py-2 focus:ring-blue-500 focus:border-blue-500 flex-1 min-w-[200px]" />
    </div>

    <!-- Map -->
    <div id="map" class="w-full h-[600px] rounded-lg shadow-md"></div>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>
@endpush

@push('scripts')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script src="{{ asset('js/map.js') }}"></script>
@endpush
