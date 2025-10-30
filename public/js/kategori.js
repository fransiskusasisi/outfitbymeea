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
                className: "text-center space-x-2 flex justify-center",
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
        createdRow: function (row, data, dataIndex) {
            // Reapply Tailwind styles if needed
            $(row).addClass("border-b border-gray-200 text-sm text-gray-700");
        },
        stripeClasses: ["bg-white", "bg-gray-50"],
    });
});

function kategoriBerhasil(message) {
    if (message) {
        Swal.fire({
            position: "center",
            icon: "success",
            text: message,
            showConfirmButton: false,
            timer: 1500,
        });
    }
}

window.deleteKategori = function (id) {
    Swal.fire({
        text: "Apakah kamu yakin?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3B82F6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Hapus",
        cancelButtonText: "Batal",
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById("delete-form-" + id).submit();
        }
    });
};
