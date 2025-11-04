<!-- Navbar -->
<header class="bg-white shadow-md flex justify-between items-center px-6 py-3">
    <div class="flex items-center space-x-4">
        <h1 class="text-lg font-semibold text-gray-700"></h1>
    </div>

    <!-- Judul Tengah -->
    {{-- <div class="absolute left-1/2 transform -translate-x-1/2">
        <h1 class="text-xl font-semibold text-gray-800 tracking-wide">Outfitbymee</h1>
    </div> --}}

    <div class="flex items-center space-x-4">
        <!-- Notifikasi -->
        {{-- <div class="relative">
            <button class="focus:outline-none">
                <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6 6 0 10-12 0v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                </svg>
            </button>
        </div> --}}

        <!-- Profil User -->
        <div class="flex items-center space-x-4">
            <img src="https://ui-avatars.com/api/?name={{ Auth::user()->nama }}" class="w-10 h-10 rounded-full"
                alt="User Avatar">

            <!-- Nama dan Role -->
            <div class="flex flex-col">
                <span class="text-gray-700 font-medium">{{ Auth::user()->nama }}</span>
                <span class="text-xs text-gray-500 capitalize">
                    {{ str_replace('_', ' ', Auth::user()->role) }}
                </span>
            </div>
        </div>

        <!-- Tombol Logout -->
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn-logout">
                @include('icons.logout-icon')Logout
            </button>
        </form>
    </div>
</header>
