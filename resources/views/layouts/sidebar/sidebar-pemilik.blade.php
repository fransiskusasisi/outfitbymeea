<aside
    class="fixed top-0 left-0 h-full w-64 bg-gradient-to-b from-purple-700 to-indigo-800 text-white p-4 space-y-2 shadow-lg">

    <!-- Header Sidebar -->
    <div class="flex flex-col items-center justify-center mb-6">
        <div class="w-20 h-20 rounded-full overflow-hidden border-4 border-white shadow-lg">
            <img src="{{ asset('images/logo.png') }}" alt="Logo Outfitbymee" class="object-cover w-full h-full">
        </div>
        <h2 class="text-xl font-semibold mt-3">Pemilik</h2>
    </div>


    <!-- Menu Utama -->
    <nav class="space-y-1">
        <!-- Dashboard -->
        <a href="{{ route('pemilik.dashboard') }}"
            class="sidebar-menu block px-4 py-2 rounded hover:bg-purple-600 transition-colors">
            <i class="fa fa-home mr-2"></i> Dashboard

        </a>

        <!-- Data Master -->
        <button onclick="toggleDropdown('data-master')"
            class="sidebar-menu w-full text-left px-4 py-2 rounded hover:bg-purple-600 transition-colors flex justify-between items-center">
            <span><i class="fa fa-box mr-2"></i> Data Master</span>
            <svg id="data-master-arrow" class="dropdown-arrow w-4 h-4" fill="none" stroke="currentColor"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
        </button>
        <div id="data-master" class="submenu pl-6">
            <a href="{{ route('barang.index') }}" class="block px-2 py-2 text-sm hover:bg-purple-600 rounded">Barang</a>
            <a href="{{ route('kategori.index') }}"
                class="block px-2 py-2 text-sm hover:bg-purple-600 rounded">Kategori</a>
            {{-- <a href="{{ route('jenisbarang.index') }}" class="block px-2 py-2 text-sm hover:bg-purple-600 rounded">Jenis Barang</a> --}}
        </div>

        <!-- Stok Barang -->
        <button onclick="toggleDropdown('stok-barang')"
            class="sidebar-menu w-full text-left px-4 py-2 rounded hover:bg-purple-600 transition-colors flex justify-between items-center">
            <span><i class="fa fa-warehouse mr-2"></i> Stok Barang</span>
            <svg id="stok-barang-arrow" class="dropdown-arrow w-4 h-4" fill="none" stroke="currentColor"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
        </button>
        <div id="stok-barang" class="submenu pl-6">
            <a href="{{ route('barangmasuk.index') }}"
                class="block px-2 py-2 text-sm hover:bg-purple-600 rounded">Barang Masuk</a>
            <a href="{{ route('barangkeluar.index') }}"
                class="block px-2 py-2 text-sm hover:bg-purple-600 rounded">Barang Keluar</a>
        </div>

        <!-- Laporan -->
        <button onclick="toggleDropdown('laporan')"
            class="sidebar-menu w-full text-left px-4 py-2 rounded hover:bg-purple-600 transition-colors flex justify-between items-center">
            <span><i class="fa fa-file-alt mr-2"></i> Laporan</span>
            <svg id="laporan-arrow" class="dropdown-arrow w-4 h-4" fill="none" stroke="currentColor"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
        </button>
        <div id="laporan" class="submenu pl-6">
            <a href="{{ route('laporan.stok') }}" class="block px-2 py-2 text-sm hover:bg-purple-600 rounded">Laporan
                Stok</a>
        </div>
    </nav>

    <!-- Logout -->
    <div class="absolute bottom-6 left-0 w-full px-4">
        <form method="POST" action="{{ route('logout') }}">
            @csrf

        </form>
    </div>
</aside>
