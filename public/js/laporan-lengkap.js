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
            data: "nama_barang",
            name: "nama_barang",
            orderable: true,
            searchable: true,
        },
        {
            data: "jml_trans_brg_masuk",
            name: "jml_trans_brg_masuk",
            orderable: false,
            searchable: false,
        },
        {
            data: "total_nilai_brg_masuk",
            name: "total_nilai_brg_masuk",
            orderable: false,
            searchable: false,
        },
        {
            data: "jml_trans_brg_keluar",
            name: "jml_trans_brg_keluar",
            orderable: false,
            searchable: false,
        },
        {
            data: "total_nilai_brg_keluar",
            name: "total_nilai_brg_keluar",
            orderable: false,
            searchable: false,
        },
    ];

    $("#my-table").DataTable({
        processing: true,
        serverSide: true,
        ajax: indexUrl,
        columns: columns,
        order: [[2, "asc"]],
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
