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
        { data: "nama_barang", name: "barang.nama_barang" },
        { data: "kode_barang", name: "barang.kode_barang" },
        { data: "harga_jual", name: "barang_masuk.harga_jual" }, 
        { data: "ukuran", name: "barang.ukuran" },
        { data: "kondisi", name: "barang.kondisi" },
        { data: "jumlah", name: "barang_masuk.jumlah" },
        { data: "tanggal", name: "barang_masuk.tanggal" },
        { data: "user_nama", name: "users.nama" }, 
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
            data: "nama_barang",
            name: "barang.nama_barang",
            orderable: true,
            searchable: true,
        },
        { data: "kode_barang", name: "barang.kode_barang" },
        { data: "harga_jual", name: "bm.harga_jual" }, 
        { data: "ukuran", name: "barang.ukuran" },
        { data: "kondisi", name: "barang.kondisi" },
        { data: "jumlah", name: "barang_keluar.jumlah" },
        { data: "tanggal", name: "barang_keluar.tanggal" },
        { data: "user_nama", name: "users.nama" },
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
