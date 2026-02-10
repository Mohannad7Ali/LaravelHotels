@extends('layouts.guest')

@section('title', 'Welcome')

@section('content')
<div class="flex flex-col items-center justify-center min-h-[70vh] space-y-6 text-center">
    <h1 class="text-4xl font-bold text-gray-800">Welcome to Hotels Map</h1>
    <p class="text-gray-600 text-lg max-w-md">
        Explore hotels around the world and find your perfect stay. Login or register to get started!
    </p>

    <div class="flex flex-wrap gap-4 justify-center mt-4">
        @auth
            <a href="{{ route('dashboard') }}" class="px-6 py-3 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition">Go to Dashboard</a>
        @else
            <a href="{{ route('login') }}" class="px-6 py-3 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition">Login</a>
            <a href="{{ route('register') }}" class="px-6 py-3 border border-blue-600 text-blue-600 rounded-md hover:bg-blue-50 transition">Register</a>
        @endauth
    </div>
</div>
@endsection
