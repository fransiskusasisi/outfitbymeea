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

    if (userRole !== "kasir") {
        columns.push({
            data: "action",
            name: "action",
        });
    }

    $("#my-table").DataTable({
        processing: true,
        serverSide: true,
        ajax: indexUrl,
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

window.deleteBarangMasuk = function (id) {
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
