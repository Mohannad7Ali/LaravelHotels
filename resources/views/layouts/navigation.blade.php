<nav class="bg-white border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">

            <!-- Logo -->
            <div class="flex-shrink-0">
                <a href="{{ route('dashboard') }}" class="text-xl font-bold text-gray-800">
                    {{ config('app.name', 'Laravel') }}
                </a>
            </div>

            <!-- Links -->
            <div class="hidden sm:flex space-x-8">
                <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'text-blue-600 font-semibold' : 'text-gray-700' }}">
                    Dashboard
                </a>
                <a href="{{ route('map.index') }}" class="{{ request()->routeIs('map.index') ? 'text-blue-600 font-semibold' : 'text-gray-700' }}">
                    Map
                </a>
            </div>

            <!-- User dropdown -->
            <div class="hidden sm:flex items-center space-x-4">
                <span class="text-gray-700">{{ Auth::user()->name }}</span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-gray-700 hover:text-red-600 transition">Logout</button>
                </form>
            </div>

            <!-- Mobile Hamburger -->
            <div class="sm:hidden">
                <button @click="open = !open" class="p-2 rounded-md text-gray-500 hover:bg-gray-100">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': !open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        <path :class="{'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div :class="{'block': open, 'hidden': !open}" class="hidden sm:hidden mt-2 space-y-1">
            <a href="{{ route('dashboard') }}" class="block px-3 py-2 rounded-md text-gray-700">Dashboard</a>
            <a href="{{ route('map.index') }}" class="block px-3 py-2 rounded-md text-gray-700">Map</a>
            <div class="border-t border-gray-200 mt-2 pt-2">
                <span class="block px-3 py-2 text-gray-700">{{ Auth::user()->name }}</span>
                <span class="block px-3 py-2 text-gray-500 text-sm">{{ Auth::user()->email }}</span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-left px-3 py-2 text-gray-700 hover:text-red-600">Logout</button>
                </form>
            </div>
        </div>
    </div>
</nav>
