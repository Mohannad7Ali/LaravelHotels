@extends('layouts.guest')

@section('title', 'Login')

@section('content')
@if(session('status'))
    <div class="mb-4 text-green-600">
        {{ session('status') }}
    </div>
@endif

<form method="POST" action="{{ route('login') }}">
    @csrf

    <div class="mb-4">
        <label for="email" class="block text-gray-700 font-medium">Email</label>
        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
        @error('email')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-4">
        <label for="password" class="block text-gray-700 font-medium">Password</label>
        <input id="password" type="password" name="password" required autocomplete="current-password" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
        @error('password')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-4 flex items-center">
        <input id="remember_me" type="checkbox" name="remember" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
        <label for="remember_me" class="ml-2 text-gray-600 text-sm">Remember me</label>
    </div>

    <div class="flex items-center justify-between mt-4">
        @if(Route::has('password.request'))
            <a href="{{ route('password.request') }}" class="text-sm text-gray-600 hover:text-gray-900 underline">Forgot your password?</a>
        @endif
        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition">Log in</button>
    </div>
</form>
@endsection
