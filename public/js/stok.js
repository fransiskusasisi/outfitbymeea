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
                name: "barang.nama_barang",
            },
            {
                data: "kategori_id",
                name: "kategori.nama",
            },
            {
                data: "stok",
                name: "barang.stok",
            },
            {
                data: "harga_jual",
                name: "bm.harga_jual",
            },
        ],
        order: [[1, "asc"]],
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
