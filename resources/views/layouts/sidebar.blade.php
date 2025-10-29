<!-- Sidebar -->
<aside class="w-64 bg-gradient-to-b from-purple-700 to-indigo-800 text-white flex-shrink-0">
    <div class="p-6">
        <div class="flex items-center space-x-3">
            <!-- Logo -->
            <div class="flex justify-center mb-6">
                <div
                    class="animate-spin-slow w-16 h-16 border-4 border-purple-600 flex items-center justify-center rounded-full shadow-lg bg-white overflow-hidden">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo Outfitbymee" class="object-contain w-full h-full">
                </div>
            </div>

            <div>
                <h2 class="text-xl font-bold">Outfitbymee</h2>
                <p class="text-xs text-purple-200">Inventory System</p>
            </div>
        </div>
    </div>

    <nav class="px-4 pb-6">
        <!-- Dashboard -->
        <a href="#" class="sidebar-menu active flex items-center space-x-3 px-4 py-3 rounded-lg mb-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
            </svg>
            <span class="font-semibold">Dashboard</span>
        </a>

        <!-- Data Master Dropdown -->
        <div class="mb-2">
            <button onclick="toggleDropdown('data-master')"
                class="sidebar-menu w-full flex items-center justify-between px-4 py-3 rounded-lg">
                <div class="flex items-center space-x-3">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4" />
                    </svg>
                    <span class="font-semibold">Data Master</span>
                </div>
                <svg id="data-master-arrow" class="w-4 h-4 dropdown-arrow" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>
            <div id="data-master" class="submenu ml-11 space-y-1 mt-1">
                <a href="#" class="block px-4 py-2 text-sm hover:text-purple-200 transition-colors">Produk</a>
                <a href="#" class="block px-4 py-2 text-sm hover:text-purple-200 transition-colors">Supplier</a>
                <a href="#" class="block px-4 py-2 text-sm hover:text-purple-200 transition-colors">Customer</a>
            </div>
        </div>

        <!-- Kategori -->
        <a href="#" class="sidebar-menu flex items-center space-x-3 px-4 py-3 rounded-lg mb-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
            </svg>
            <span class="font-semibold">Kategori</span>
        </a>

        <!-- Stok -->
        <a href="#" class="sidebar-menu flex items-center space-x-3 px-4 py-3 rounded-lg mb-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
            </svg>
            <span class="font-semibold">Kelola Stok</span>
        </a>

        <!-- Transaksi -->
        <a href="#" class="sidebar-menu flex items-center space-x-3 px-4 py-3 rounded-lg mb-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
            </svg>
            <span class="font-semibold">Transaksi</span>
        </a>

        <!-- Laporan Dropdown -->
        <div class="mb-2">
            <button onclick="toggleDropdown('laporan')"
                class="sidebar-menu w-full flex items-center justify-between px-4 py-3 rounded-lg">
                <div class="flex items-center space-x-3">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    <span class="font-semibold">Laporan</span>
                </div>
                <svg id="laporan-arrow" class="w-4 h-4 dropdown-arrow" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>
            <div id="laporan" class="submenu ml-11 space-y-1 mt-1">
                <a href="#" class="block px-4 py-2 text-sm hover:text-purple-200 transition-colors">Laporan
                    Stok</a>
                <a href="#" class="block px-4 py-2 text-sm hover:text-purple-200 transition-colors">Laporan
                    Penjualan</a>
                <a href="#" class="block px-4 py-2 text-sm hover:text-purple-200 transition-colors">Laporan
                    Keuangan</a>
            </div>
        </div>

        <!-- Settings -->
        <a href="#" class="sidebar-menu flex items-center space-x-3 px-4 py-3 rounded-lg mb-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
            <span class="font-semibold">Pengaturan</span>
        </a>
    </nav>
</aside>
