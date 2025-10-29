<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard') - Outfitbymee</title>

    {{-- Tailwind CSS --}}
    {{-- <script src="https://cdn.tailwindcss.com"></script> --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        .sidebar-menu {
            transition: all 0.3s ease;
        }

        .sidebar-menu:hover {
            background: rgba(102, 126, 234, 0.1);
            border-left: 4px solid #667eea;
        }

        .sidebar-menu.active {
            background: linear-gradient(90deg, rgba(102, 126, 234, 0.2) 0%, rgba(102, 126, 234, 0.05) 100%);
            border-left: 4px solid #667eea;
            color: #667eea;
        }

        .dropdown-arrow {
            transition: transform 0.3s ease;
        }

        .dropdown-arrow.open {
            transform: rotate(180deg);
        }

        .submenu {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease;
        }

        .submenu.open {
            max-height: 500px;
        }
    </style>
</head>

<body class="bg-gray-50 overflow-y-auto min-h-screen">
    <div class="flex min-h-screen">

        {{-- Sidebar --}}
        @auth
            @includeIf('layouts.sidebar.sidebar-' . auth()->user()->role)
        @endauth

        {{-- Konten utama --}}
        <div class="flex flex-col flex-1 min-h-screen" style="margin-left: 270px;"> {{-- otomatis menyesuaikan jarak dari sidebar --}}

            {{-- Navbar --}}
            @include('layouts.navbar')

            {{-- Area Konten --}}
            <main class="flex-1 p-8 overflow-y-auto bg-gray-50">
                @yield('content')
            </main>

            {{-- Footer --}}
            @include('layouts.footer')
        </div>
    </div>

    {{-- Script Dropdown Sidebar --}}
    <script>
        function toggleDropdown(id) {
            const submenu = document.getElementById(id);
            const arrow = document.getElementById(id + '-arrow');
            submenu.classList.toggle('open');
            arrow.classList.toggle('open');
        }

        // Dropdown profil
        function toggleProfileDropdown() {
            const dropdown = document.getElementById('profile-dropdown');
            dropdown.classList.toggle('hidden');
        }

        // Tutup dropdown profil kalau klik di luar area
        document.addEventListener('click', function(event) {
            const profileBtn = document.getElementById('profile-btn');
            const dropdown = document.getElementById('profile-dropdown');

            if (profileBtn && !profileBtn.contains(event.target) && !dropdown.contains(event.target)) {
                dropdown.classList.add('hidden');
            }
        });
    </script>
    <!-- jQuery & DataTables -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/jquery.dataTables.min.css">

    @stack('scripts')
</body>
<script>
    function toggleDropdown(id) {
        const submenu = document.getElementById(id);
        const arrow = document.getElementById(id + '-arrow');
        submenu.classList.toggle('open');
        arrow.classList.toggle('open');

        // Simpan status dropdown di localStorage
        const isOpen = submenu.classList.contains('open');
        localStorage.setItem('dropdown-' + id, isOpen);
    }

    document.addEventListener('DOMContentLoaded', function() {
        // Saat reload, buka kembali dropdown yang sebelumnya terbuka
        const dropdowns = document.querySelectorAll('.submenu');
        dropdowns.forEach(submenu => {
            const id = submenu.id;
            const isOpen = localStorage.getItem('dropdown-' + id) === 'true';
            const arrow = document.getElementById(id + '-arrow');

            if (isOpen) {
                submenu.classList.add('open');
                arrow?.classList.add('open');
            }
        });
    });
</script>

</html>
