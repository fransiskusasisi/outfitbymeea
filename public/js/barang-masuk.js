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
                if (type === "display" || type === "filter") return data;
                return "";
            },
            orderable: false,
            searchable: false,
        },
        { data: "barang_id", name: "barang.nama_barang" }, // jika ingin sort by nama barang
        { data: "kode_barang", name: "barang.kode_barang" },
        { data: "harga_jual", name: "barang_masuk.harga_jual" },
        { data: "ukuran", name: "barang.ukuran" },
        { data: "kondisi", name: "barang.kondisi" },
        { data: "jumlah", name: "barang_masuk.jumlah", orderable: true }, // <-- penting
        { data: "tanggal", name: "barang_masuk.tanggal" },
        { data: "user_id", name: "users.nama" }, // jika ingin sort by user name
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
