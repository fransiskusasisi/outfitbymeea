$(function () {
    const columns = [
        {
            data: "DT_RowIndex",
            name: "DT_RowIndex",
            className: "text-center",
            orderable: false,
            searchable: false,
        },
        {
            data: "gambar",
            name: "gambar",
            render: function (data, type, row, meta) {
                if (type === "display" || type === "filter") {
                    return data; // Kembalikan string HTML yang dihasilkan oleh controller
                }
                return ""; // atau nilai lain untuk sorting/filtering
            },
            orderable: false,
            searchable: false,
        },
        {
            data: "barang_id",
            name: "barang_id",
        },
        {
            data: "kode_barang",
            name: "kode_barang",
        },
        {
            data: "harga_jual",
            name: "harga_jual",
        },
        {
            data: "ukuran",
            name: "ukuran",
        },
        {
            data: "kondisi",
            name: "kondisi",
        },
        {
            data: "jumlah",
            name: "jumlah",
        },
        {
            data: "tanggal",
            name: "tanggal",
        },
        {
            data: "user_id",
            name: "user_id",
        },
    ];

    $("#barang-masuk-table").DataTable({
        processing: true,
        serverSide: true,
        ajax: indexBarangMasukUrl,
        columns: columns,
        language: {
            search: "_INPUT_",
            searchPlaceholder: "Cari barang...",
            lengthMenu: "Tampilkan _MENU_ data",
            info: "Menampilkan _START_ - _END_ dari _TOTAL_ data",
            paginate: {
                previous: "Sebelumnya",
                next: "Berikutnya",
            },
        },
    });
});

$(function () {
    const columns = [
        {
            data: "DT_RowIndex",
            name: "DT_RowIndex",
            className: "text-center",
            orderable: false,
            searchable: false,
        },
        {
            data: "gambar",
            name: "gambar",
            render: function (data, type, row, meta) {
                if (type === "display" || type === "filter") {
                    return data;
                }
                return "";
            },
            orderable: false,
            searchable: false,
        },
        {
            data: "barang_id",
            name: "barang_id",
        },
        {
            data: "kode_barang",
            name: "kode_barang",
        },
        {
            data: "harga_jual",
            name: "harga_jual",
        },
        {
            data: "ukuran",
            name: "ukuran",
        },
        {
            data: "kondisi",
            name: "kondisi",
        },
        {
            data: "jumlah",
            name: "jumlah",
        },
        {
            data: "tanggal",
            name: "tanggal",
        },
        {
            data: "user_id",
            name: "user_id",
        },
    ];

    $("#barang-keluar-table").DataTable({
        processing: true,
        serverSide: true,
        ajax: indexBarangKeluarUrl,
        columns: columns,
        language: {
            search: "_INPUT_",
            searchPlaceholder: "Cari barang...",
            lengthMenu: "Tampilkan _MENU_ data",
            info: "Menampilkan _START_ - _END_ dari _TOTAL_ data",
            paginate: {
                previous: "Sebelumnya",
                next: "Berikutnya",
            },
        },
    });
});
