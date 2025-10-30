$(function () {
    $("#my-table").DataTable({
        processing: true,
        serverSide: true,
        ajax: indexUrl,
        columns: [
            {
                data: "DT_RowIndex",
                name: "DT_RowIndex",
                className: "text-center",
                orderable: false,
                searchable: false,
            },
            {
                data: "nama_barang",
                name: "nama_barang",
            },
            {
                data: "kategori_id",
                data: "kategori_id",
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
                data: "harga_beli",
                name: "harga_beli",
            },
            {
                data: "harga_jual",
                name: "harga_jual",
            },
            {
                data: "stok",
                name: "stok",
            },
            {
                data: "action",
                name: "action",
            },
        ],
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
