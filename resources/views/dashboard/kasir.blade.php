@extends('layouts.app')

@section('title', 'Dashboard Pemilik')

@section('page-title', 'Dashboard Pemilik')

@section('page-subtitle', 'Selamat datang di dashboard Outfitbymee')

@section('content')
<div class="space-y-6 ml-64 p-6"> {{-- margin kiri agar tidak tertutup sidebar --}}
    
    <!-- Laporan Stok -->
    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <div class="bg-gradient-to-r from-purple-600 to-indigo-600 px-6 py-4">
            <h3 class="text-lg font-bold text-white">Laporan Stok</h3>
            <p class="text-purple-100 text-sm">Data stok barang terkini</p>
        </div>
        
        <div class="p-6">
            <!-- Filter Periode -->
            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Filter Periode</label>
                <div class="flex flex-col md:flex-row md:space-x-2 space-y-2 md:space-y-0">
                    <input type="date" class="flex-1 px-4 py-2 border-2 border-gray-200 rounded-lg focus:border-purple-500 focus:outline-none transition-colors">
                    <input type="date" class="flex-1 px-4 py-2 border-2 border-gray-200 rounded-lg focus:border-purple-500 focus:outline-none transition-colors">
                    <button class="px-6 py-2 bg-purple-600 text-white font-semibold rounded-lg hover:bg-purple-700 transition-colors">
                        Filter
                    </button>
                </div>
            </div>

            <!-- Table -->
            <div class="overflow-x-auto">
                <table class="w-full border-collapse">
                    <thead>
                        <tr class="bg-gray-100 border-b-2 border-gray-200">
                            <th class="text-left py-3 px-4 text-sm font-semibold text-gray-700">Nama Barang</th>
                            <th class="text-left py-3 px-4 text-sm font-semibold text-gray-700">Stok</th>
                            <th class="text-left py-3 px-4 text-sm font-semibold text-gray-700">Kategori</th>
                            <th class="text-left py-3 px-4 text-sm font-semibold text-gray-700">Terakhir Diperbarui</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Contoh Data -->
                        <tr class="border-b hover:bg-gray-50">
                            <td class="py-3 px-4 text-sm text-gray-600">Kemeja Linen Pria</td>
                            <td class="py-3 px-4 text-sm text-gray-600">25</td>
                            <td class="py-3 px-4 text-sm text-gray-600">Pakaian</td>
                            <td class="py-3 px-4 text-sm text-gray-600">22 Okt 2025</td>
                        </tr>
                        <tr class="border-b hover:bg-gray-50">
                            <td class="py-3 px-4 text-sm text-gray-600">Dress Floral</td>
                            <td class="py-3 px-4 text-sm text-gray-600">12</td>
                            <td class="py-3 px-4 text-sm text-gray-600">Pakaian Wanita</td>
                            <td class="py-3 px-4 text-sm text-gray-600">21 Okt 2025</td>
                        </tr>
                        <!-- Tambah data lain di sini -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
