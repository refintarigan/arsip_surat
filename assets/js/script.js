function hapusAdmin(id) {
  Swal.fire({
    title: "Apakah Anda yakin?",
    text: "Data ini akan dihapus secara permanen!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#d33",
    cancelButtonColor: "#3085d6",
    confirmButtonText: "Ya, hapus!",
    cancelButtonText: "Batal",
  }).then((result) => {
    if (result.isConfirmed) {
      window.location.href = `proses_data/proses_data_all.php?id=${id}`;
    }
  });
}
