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
            name: "barang.nama_barang",
        },
        {
            data: "jumlah",
            data: "jumlah",
        },
        {
            data: "tanggal",
            name: "tanggal",
        },
        {
            data: "user_nama",
            name: "users.nama",
            orderable: true,
            searchable: true,
        },
        {
            data: "action",
            name: "action",
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

window.deleteBarangKeluar = function (id) {
    Swal.fire({
        text: "Apakah kamu yakin?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#f59e0b",
        confirmButtonText: `<div class="flex items-center">
            <span class="inline-block">${iconOke}</span>
            <span>Hapus</span>
        </div>`,
        cancelButtonText: `<div class="flex items-center">
            <span class="inline-block">${iconBatal}</span>
            <span>Batal</span>
        </div>`,
        customClass: {
            confirmButton: "btn-merah",
            cancelButton: "btn-ungu",
        },
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById("delete-form-" + id).submit();
        }
    });
};
