@extends('layouts.app')

@section('title', 'Dashboard Pemilik')
@section('page-title', 'Dashboard Pemilik')
@section('page-subtitle', 'Selamat datang di dashboard Outfitbymee')

@section('content')
    <div class="w-full p-8 space-y-6 text-gray-600">

        <!-- Judul Halaman -->
        <div class="mb-6">
            <h1 class="text-3xl font-bold text-gray-800">Dashboard Pemilik</h1>
            <p class="text-gray-500 text-sm mt-1">Selamat datang kembali, semoga harimu menyenangkan ✨</p>
        </div>

        {{-- isi dashboard --}}
        <div class="flex gap-4">
            <div class="w-full">
                <div
                    class="bg-gradient-to-r from-hijautosca to-emerald-300 rounded-t-lg shadow-md p-6 text-white flex items-center gap-4">
                    <div class="w-20 h-20 flex justify-center items-center">
                        @include('icons.history-icon')
                    </div>
                    <div class="w-full flex">
                        <div class="items-center flex-grow">
                            <p class="font-bold mb-2">Riwayat Login</p>
                            <p class="text-4xl font-bold ">{{ $riwayatLogin }}</p>
                        </div>
                        <div class="flex justify-end items-end">
                            <p class="italic text-sm font-bold">Users</p>
                        </div>
                    </div>
                </div>
                <div class="w-full flex bg-white py-2 px-4 rounded-b-lg shadow-md">
                    <a href="{{ route('pemilik.riwayatlogin.index') }}" class="font-bold hover:opacity-60">Detail</a>
                </div>
            </div>
        </div>
        <div class="flex gap-4 my-4">
            <div class="w-full rounded-xl shadow-md flex gap-4 text-gray-600 ">
                <div class=" w-full bg-white rounded-lg shadow-sm md:p-6">
                    <div class="flex justify-between">
                        <div class="mb-6">
                            <h5 class="text-xl font-bold dark:text-light1 leading-none text-gray-900  pe-1">
                                Analisis
                                Barang</h5>
                            <p class="text-sm text-gray-500 ">Data diambil berdasarkan tahun yang
                                dipilih</p>
                        </div>
                        <form action="">
                            <select name="filter_tahun" id="filter_tahun" class="mr-6 select-no-border cursor-pointer">
                                @foreach ($listTahun as $tahun)
                                    <option value="{{ $tahun }}" {{ $tahun == date('Y') ? 'selected' : '' }}>
                                        {{ $tahun }}
                                    </option>
                                @endforeach
                            </select>
                        </form>
                    </div>
                    <hr>
                    <div id="column-chart"></div>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-xl shadow-md w-full">
            <div class="bg-gradient-to-r from-purple-600 to-indigo-600 p-6 rounded-t-xl">
                <h3 class="text-2xl font-bold text-white">Laporan Stok Terkini</h3>
            </div>
            <div class="p-6">
                @foreach ($stok as $item)
                    <div class="w-full border-b py-2 flex justify-between mb-2">
                        <div class=" flex items-center gap-4">
                            <div class="w-20 h-20 rounded-full overflow-hidden shadow-lg">
                                <img class="w-full h-full object-cover"
                                    src="{{ optional($item->latestMasuk)->gambar ? asset('storage/images/barang/' . optional($item->latestMasuk)->gambar) : asset('/images/no-img.jpg') }}"
                                    alt="{{ $item->nama_barang }}">
                            </div>
                            <div>
                                <p class="font-semibold text-lg">{{ $item->nama_barang }}</p>
                                <p class="text-sm text-gray-500">Kategori: {{ $item->kategori->nama ?? '-' }}</p>
                            </div>
                        </div>
                        <div>
                            <p class="font-semibold text-lg">Stok: {{ $item->stok }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        let chart;
        async function loadChart(tahun) {
            try {
                const response = await fetch(`{{ route('get.chart.bar') }}?tahun=${tahun}`);
                if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);
                const data = await response.json();
                const categories = data.barangMasuk.map(item => item.x);
                const seriesMasuk = data.barangMasuk.map(item => item.y);
                const seriesKeluar = data.barangKeluar.map(item => item.y);

                const options = {
                    colors: ["#8b5cf6", "#38bdf8"],
                    series: [{
                            name: "Barang Masuk",
                            data: seriesMasuk
                        },
                        {
                            name: "Barang Keluar",
                            data: seriesKeluar
                        }
                    ],
                    chart: {
                        type: "bar",
                        height: 320,
                        fontFamily: "Inter, sans-serif",
                        toolbar: {
                            show: false
                        },
                    },
                    plotOptions: {
                        bar: {
                            horizontal: false,
                            columnWidth: "70%",
                            borderRadiusApplication: "end",
                            borderRadius: 8,
                        },
                    },
                    tooltip: {
                        shared: true,
                        intersect: false
                    },
                    states: {
                        hover: {
                            filter: {
                                type: "darken",
                                value: 1
                            }
                        }
                    },
                    stroke: {
                        show: true,
                        width: 0,
                        colors: ["transparent"]
                    },
                    grid: {
                        show: false,
                        strokeDashArray: 4,
                        padding: {
                            left: 2,
                            right: 2,
                            top: -14
                        }
                    },
                    dataLabels: {
                        enabled: false
                    },
                    legend: {
                        show: true,
                        position: 'bottom',
                        fontFamily: 'Poppins, sans-serif'
                    },
                    xaxis: {
                        categories: categories,
                        type: 'category',
                        labels: {
                            show: true,
                            style: {
                                fontFamily: "Inter, sans-serif",
                                cssClass: 'text-xs font-normal fill-gray-500 dark:fill-gray-400'
                            }
                        },
                        axisBorder: {
                            show: true
                        },
                        axisTicks: {
                            show: true
                        },
                    },
                    yaxis: {
                        show: true
                    },
                    fill: {
                        opacity: 1
                    },
                };

                if (chart) {
                    chart.destroy();
                    chart = null;
                }
                chart = new ApexCharts(document.querySelector("#column-chart"), options);
                chart.render();
            } catch (error) {
                console.error("Error loading chart barang:", error);
            }
        }

        document.addEventListener("DOMContentLoaded", function() {
            const tahunBarang = document.querySelector("#filter_tahun")?.value || new Date().getFullYear();
            loadChart(tahunBarang);
        });

        document.querySelector("#filter_tahun")?.addEventListener("change", function() {
            loadChart(this.value);
        });
    </script>
@endpush
