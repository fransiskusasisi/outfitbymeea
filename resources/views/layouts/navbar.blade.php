<!-- Navbar -->
<header class="bg-white shadow-md flex justify-between items-center px-6 py-3 relative">
    <div class="flex items-center space-x-4">
        <h1 class="text-lg font-semibold text-gray-700"></h1>
    </div>

    <div class="flex items-center space-x-6">
        <!-- Notifikasi -->
        <div class="relative ">
            <button id="notif_btn" class="focus:outline-none relative flex justify-center">
                @include('icons.notif-icon')
                <!-- Titik merah -->
                <span id="notif_dot"
                    class="absolute top-0 right-0 block w-2 h-2 bg-red-500 rounded-full transform translate-x-1 -translate-y-1">
                </span>
            </button>

            <!-- Dropdown Notifikasi -->
            <div id="notif_dropdown"
                class="hidden absolute right-0 mt-2 w-80 bg-white border border-gray-200 rounded-lg shadow-lg z-50 ">
                <div class="px-4 py-2 border-b border-gray-100 flex justify-between items-center">
                    <h2 class="text-sm font-semibold text-gray-700">Notifikasi</h2>
                    <button id="close_notif"
                        class="text-gray-400 hover:text-gray-600 text-xs ">@include('icons.silang-icon')</button>
                </div>

                <ul class="max-h-96 overflow-y-auto">
                    <!-- Contoh data notifikasi -->
                    <li class="px-4 py-3 hover:bg-gray-50 cursor-pointer">
                        <p class="text-sm text-gray-700">Pesanan baru telah masuk</p>
                        <span class="text-xs text-gray-400">2 menit yang lalu</span>
                    </li>
                    <li class="px-4 py-3 hover:bg-gray-50 cursor-pointer">
                        <p class="text-sm text-gray-700">Barang keluar telah dikonfirmasi</p>
                        <span class="text-xs text-gray-400">1 jam yang lalu</span>
                    </li>
                    <li class="px-4 py-3 hover:bg-gray-50 cursor-pointer">
                        <p class="text-sm text-gray-700">Stok barang “Kaos Oversize” hampir habis</p>
                        <span class="text-xs text-gray-400">Kemarin</span>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Profil User -->
        <a href="{{ route('profile') }}" class="hover:opacity-60 transition-all">
            <div class="flex items-center space-x-2">
                <div class="bg-gray-300 p-2 rounded-full text-white">
                    @include('icons.user-icon')
                </div>
                <div class="flex flex-col">
                    <span class="text-gray-700 font-medium">{{ Auth::user()->nama }}</span>
                    <span class="text-xs text-gray-500 capitalize">
                        {{ str_replace('_', ' ', Auth::user()->role) }}
                    </span>
                </div>
            </div>
        </a>

        <!-- Tombol Logout -->
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn-logout flex items-center space-x-1">
                @include('icons.logout-icon')
                <span>Logout</span>
            </button>
        </form>
    </div>
</header>

<!-- Script -->
<script>
    const notifBtn = document.getElementById('notif_btn');
    const notifDropdown = document.getElementById('notif_dropdown');
    const notifList = notifDropdown.querySelector('ul');
    const closeNotif = document.getElementById('close_notif');
    const notifDot = document.getElementById('notif_dot');

    // Fungsi bantu: format time ago (tetap gunakan ini)
    function timeAgo(date) {
        const now = new Date();
        const seconds = Math.floor((now - date) / 1000);

        const intervals = {
            tahun: 31536000,
            bulan: 2592000,
            minggu: 604800,
            hari: 86400,
            jam: 3600,
            menit: 60,
            detik: 1,
        };

        for (const [key, value] of Object.entries(intervals)) {
            const interval = Math.floor(seconds / value);
            if (interval >= 1) {
                return `${interval} ${key}${interval > 1 ? '' : ''} yang lalu`;
            }
        }
        return "Baru saja";
    }

    // Ambil URL berdasarkan role
    const role = "{{ Auth::user()->role }}";
    let barangUrl = "#";
    if (role === 'pemilik') {
        barangUrl = "{{ route('pemilik.barang.index') }}";
    } else if (role === 'petugas_gudang') {
        barangUrl = "{{ route('gudang.barang.index') }}";
    } else if (role === 'kasir') {
        barangUrl = "{{ route('kasir.barang.index') }}";
    }

    // ===== FUNGSI UTAMA =====

    // Periksa apakah perlu tampilkan titik merah
    function updateNotifDot() {
        const lastReadAtStr = localStorage.getItem('last_notif_read_at');
        const lastReadAt = lastReadAtStr ? new Date(lastReadAtStr) : null;

        fetch(`{{ url('/notifikasi-barang') }}`)
            .then(response => response.json())
            .then(notifs => {
                let hasNew = false;

                if (notifs.length > 0) {
                    for (const item of notifs) {
                        const updatedAt = new Date(item.updated_at);
                        if (!lastReadAt || updatedAt > lastReadAt) {
                            hasNew = true;
                            break;
                        }
                    }
                }

                if (hasNew) {
                    notifDot.classList.remove('hidden');
                } else {
                    notifDot.classList.add('hidden');
                }
            })
            .catch(err => {
                console.error("Gagal cek notifikasi untuk titik:", err);
                notifDot.classList.add('hidden');
            });
    }

    function markNotifAsRead() {
        const now = new Date().toISOString(); // format ISO: "2025-11-28T12:00:00.000Z"
        localStorage.setItem('last_notif_read_at', now);
        notifDot.classList.add('hidden');
    }

    // Muat status titik saat halaman pertama kali dimuat
    document.addEventListener("DOMContentLoaded", () => {
        updateNotifDot();
    });

    // Event klik notifikasi
    notifBtn.addEventListener('click', async (e) => {
        e.stopPropagation();
        const willOpen = notifDropdown.classList.contains('hidden');
        notifDropdown.classList.toggle('hidden');

        if (willOpen) {
            markNotifAsRead();
            notifList.innerHTML = `<li class="px-4 py-3 text-gray-500 text-sm">Memuat notifikasi...</li>`;

            try {
                const response = await fetch(`{{ url('/notifikasi-barang') }}`);
                const data = await response.json();

                if (data.length === 0) {
                    notifList.innerHTML =
                        `<li class="px-4 py-3 text-gray-500 text-sm text-center">Tidak ada barang yang menipis 🎉</li>`;
                } else {
                    notifList.innerHTML = data.map(item => `
                    <a href="${barangUrl}">
                        <li class="px-4 py-3 hover:bg-gray-50 cursor-pointer border-b border-gray-100">
                            <p class="text-sm text-gray-700">
                                <span class="font-semibold">${item.nama_barang}</span> <br> stok tersisa 
                                <span class="text-red-500 text-sm">${item.stok}</span>
                            </p>
                            <span class="text-xs text-gray-400">Terakhir diperbarui ${timeAgo(new Date(item.updated_at))}</span>
                        </li>
                    </a>
                    `).join('');
                }
            } catch (error) {
                notifList.innerHTML =
                    `<li class="px-4 py-3 text-red-500 text-sm">Gagal memuat data notifikasi.</li>`;
                console.error(error);
            }
        }
    });

    // Tutup dropdown
    closeNotif.addEventListener('click', () => {
        notifDropdown.classList.add('hidden');
    });

    // Klik di luar → tutup
    document.addEventListener('click', (e) => {
        if (!notifDropdown.contains(e.target) && !notifBtn.contains(e.target)) {
            notifDropdown.classList.add('hidden');
        }
    });
</script>
