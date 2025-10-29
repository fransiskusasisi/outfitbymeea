<!-- resources/views/layouts/partials/navbar_pemilik.blade.php -->
<header class="bg-white shadow-md flex justify-between items-center px-6 py-3">
    <div class="flex items-center space-x-4">
        <h1 class="text-lg font-semibold text-gray-700">Dashboard Pemilik</h1>
    </div>

    <div class="absolute left-1/2 transform -translate-x-1/2">
        <h1 class="text-xl font-semibold text-gray-800 tracking-wide">Outfitbymee</h1>
    </div>

    <div class="flex items-center space-x-4">
        <div class="relative">
            <button class="focus:outline-none">
                <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6 6 0 10-12 0v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                </svg>
            </button>
        </div>
        <div class="flex items-center space-x-2">
            <img src="https://ui-avatars.com/api/?name={{ auth()->user()->nama }}" class="w-8 h-8 rounded-full" alt="User Avatar">
            <span class="text-gray-700 font-medium">{{ auth()->user()->nama }}</span>
        </div>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="text-sm bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-md">Logout</button>
        </form>
    </div>
</header>
