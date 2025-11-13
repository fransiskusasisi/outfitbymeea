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
            data: "user_id",
            name: "user_id",
        },
        {
            data: "role",
            name: "role",
        },
        {
            data: "login_at",
            name: "login_at",
        },
        {
            data: "logout_at",
            name: "logout_at",
        },
        {
            data: "ip_address",
            name: "ip_address",
        },
    ];

    $("#my-table").DataTable({
        processing: true,
        serverSide: true,
        ajax: indexUrl,
        columns: columns,
        language: {
            search: "_INPUT_",
            searchPlaceholder: "Cari user...",
            lengthMenu: "Tampilkan _MENU_ data",
            info: "Menampilkan _START_ - _END_ dari _TOTAL_ data",
            paginate: {
                previous: "Sebelumnya",
                next: "Berikutnya",
            },
        },
    });
});

window.deleteBarang = function (id) {
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
