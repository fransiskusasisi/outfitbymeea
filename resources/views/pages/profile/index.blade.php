@extends('layouts.app')
@section('title', 'Profile')
@section('content')
    <div class="p-8 space-y-6 ">
        <!-- Judul Halaman -->
        <div class="mb-6">
            <h1 class="text-3xl font-bold text-gray-800">Profile Saya</h1>
            <p class="text-gray-500 text-sm mt-1">Informasi dasar akun Anda — pribadi dan aman.</p>
        </div>

        <!-- Card -->
        <div class="mx-10 bg-white shadow-xl rounded-2xl overflow-hidden ring-1 ring-gray-100">
            <!-- Header -->
            <div class="bg-gradient-to-r from-purple-600 to-indigo-600 p-6">
                <div class="flex items-center gap-4">
                    <!-- Avatar -->
                    <div
                        class="w-24 h-24 md:w-28 md:h-28 rounded-full bg-white/20 flex items-center justify-center text-white text-3xl md:text-4xl font-semibold ring-2 ring-white/30">
                        {{ strtoupper(substr(auth()->user()->nama, 0, 1)) }}
                    </div>

                    <div class="flex-1 min-w-0">
                        <div class="flex items-center justify-between gap-4">
                            <div>
                                <h2 class="text-white text-2xl md:text-3xl font-bold leading-tight">
                                    {{ auth()->user()->nama }}
                                </h2>
                                <p class="text-indigo-100 mt-1">
                                    <svg class="inline-block w-4 h-4 mr-1 -mt-0.5" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M5.121 17.804A13.937 13.937 0 0112 15c2.89 0 5.56.86 7.879 2.33M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    {{ auth()->user()->username }}
                                </p>
                            </div>

                            <div class="flex items-center gap-3">
                                <span
                                    class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-white/20 text-white/90 ring-1 ring-white/20">
                                    <!-- role badge -->
                                    <svg class="w-4 h-4 mr-2 opacity-90" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M5 13l4 4L19 7" />
                                    </svg>
                                    {{ ucfirst(auth()->user()->role) }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Body -->
            <div class="p-6 md:p-8">
                <!-- Left column: basic info -->
                <div class=" bg-gray-50 rounded-xl p-5 shadow-sm">
                    <h3 class="text-lg font-semibold text-gray-800 mb-3">Informasi Akun</h3>

                    <dl class="divide-y divide-gray-200">
                        <div class="py-3 flex justify-between items-center">
                            <dt class="text-sm text-gray-600">Nama Lengkap</dt>
                            <dd class="text-sm font-medium text-gray-900">{{ auth()->user()->nama }}</dd>
                        </div>

                        <div class="py-3 flex justify-between items-center">
                            <dt class="text-sm text-gray-600">Username</dt>
                            <dd class="text-sm font-medium text-gray-900">{{ auth()->user()->username }}</dd>
                        </div>

                        <div class="py-3 flex justify-between items-center">
                            <dt class="text-sm text-gray-600">Role</dt>
                            <dd class="text-sm font-medium text-gray-900">{{ auth()->user()->role }}</dd>
                        </div>
                    </dl>

                </div>

                <!-- Optional footer note -->
                <div class="mt-6 text-sm text-gray-500">
                    <p>Informasi ini hanya dapat dilihat oleh Anda.
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
