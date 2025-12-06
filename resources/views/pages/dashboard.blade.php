@extends('layouts.app')

@section('title', 'Dashboard Pemilik')
@section('page-title', 'Dashboard Pemilik')
@section('page-subtitle', 'Selamat datang di dashboard Outfitbymee')

@section('content')
    <div class="w-full p-8 space-y-6">

        <!-- Judul Halaman -->
        <div class="mb-6">
            <h1 class="text-3xl font-bold text-gray-800">Dashboard Pemilik</h1>
            <p class="text-gray-500 text-sm mt-1">Selamat datang kembali, semoga harimu menyenangkan ✨</p>
        </div>

        {{-- isi dashboard --}}
        <div class="flex gap-4">
            <div class="w-1/2 bg-gradient-to-r from-hijautosca to-emerald-300 rounded-lg shadow-md p-6 text-white">
                <p class="font-bold mb-2">Total Barang Masuk</p>
                <p class="text-4xl font-bold">124</p>
                <div class="flex justify-end">
                    <p class="italic text-sm font-bold">Unit</p>
                </div>
            </div>
            <div class="w-1/2 bg-gradient-to-r from-merahorange to-orange-300 rounded-lg shadow-md p-6 text-white">
                <p class="font-bold mb-2">Total Barang Keluar</p>
                <p class="text-4xl font-bold">128</p>
                <div class="flex justify-end">
                    <p class="italic text-sm font-bold">Unit</p>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-xl shadow-md w-full">
        </div>
    </div>
@endsection
