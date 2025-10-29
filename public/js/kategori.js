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
                data: "nama",
                name: "nama",
            },
            {
                data: "action",
                name: "action",
            },
        ],
        language: {
            search: "_INPUT_",
            searchPlaceholder: "Cari kategori...",
            lengthMenu: "Tampilkan _MENU_ data",
            info: "Menampilkan _START_ - _END_ dari _TOTAL_ data",
            paginate: {
                previous: "Sebelumnya",
                next: "Berikutnya",
            },
        },
    });
});
