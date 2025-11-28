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
        },
        {
            data: "jml_trans_brg_masuk",
            name: "jml_trans_brg_masuk",
        },
        {
            data: "total_nilai_brg_masuk",
            name: "total_nilai_brg_masuk",
        },
        {
            data: "jml_trans_brg_keluar",
            name: "jml_trans_brg_keluar",
        },
        {
            data: "total_nilai_brg_keluar",
            name: "total_nilai_brg_keluar",
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

// window.deleteBarang = function (id) {
//     Swal.fire({
//         text: "Apakah kamu yakin?",
//         icon: "warning",
//         showCancelButton: true,
//         confirmButtonColor: "#d33",
//         cancelButtonColor: "#f59e0b",
//         confirmButtonText: `<div class="flex items-center">
//             <span class="inline-block">${iconOke}</span>
//             <span>Hapus</span>
//         </div>`,
//         cancelButtonText: `<div class="flex items-center">
//             <span class="inline-block">${iconBatal}</span>
//             <span>Batal</span>
//         </div>`,
//         customClass: {
//             confirmButton: "btn-merah",
//             cancelButton: "btn-ungu",
//         },
//     }).then((result) => {
//         if (result.isConfirmed) {
//             document.getElementById("delete-form-" + id).submit();
//         }
//     });
// };
