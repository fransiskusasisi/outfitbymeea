<aside
    class="fixed top-0 left-0 h-full w-64 bg-gradient-to-b from-purple-700 to-indigo-800 text-white p-4 space-y-2 shadow-lg">

    <!-- Header Sidebar -->
    <div class="flex flex-col items-center justify-center mb-6">
        <div class="w-20 h-20 rounded-full overflow-hidden border-4 border-white shadow-lg">
            <img src="{{ asset('images/logo-compressed.png') }}" alt="Logo Outfitbymee" class="object-cover w-full h-full">
        </div>
        <h2 class="text-xl font-semibold mt-3">Pemilik</h2>
    </div>


    <!-- Menu Utama -->
    <nav class="space-y-1">
        <!-- Dashboard -->
        <a href="{{ route('pemilik.dashboard') }}"
            class="sidebar-menu block px-4 py-2 rounded hover:bg-purple-600 transition-colors">
            <i class="fa-solid fa-house mr-2"></i>Dashboard
        </a>
        <a href="{{ route('pemilik.laporan.lengkap') }}"
            class="sidebar-menu block px-4 py-2 rounded hover:bg-purple-600 transition-colors">
            <i class="fa fa-file-alt mr-2"></i> Laporan
        </a>
        <a href="{{ route('pemilik.laporan.stok') }}""
            class="sidebar-menu block px-4 py-2 rounded hover:bg-purple-600 transition-colors">
            <i class="fa fa-file-alt mr-2"></i> Laporan Stok
        </a>
        <a href="{{ route('pemilik.laporan.transaksi') }}""
            class="sidebar-menu block px-4 py-2 rounded hover:bg-purple-600 transition-colors">
            <i class="fa fa-file-alt mr-2"></i> Laporan Transaksi
        </a>

        <a href="{{ route('pemilik.riwayatlogin.index') }}"
            class="sidebar-menu block px-4 py-2 rounded hover:bg-purple-600 transition-colors">
            <i class="fa-solid fa-clock-rotate-left mr-2"></i>Riwayat Login
        </a>
    </nav>

    <!-- Logout -->
    <div class="absolute bottom-6 left-0 w-full px-4">
        <form method="POST" action="{{ route('logout') }}">
            @csrf

        </form>
    </div>
</aside>
