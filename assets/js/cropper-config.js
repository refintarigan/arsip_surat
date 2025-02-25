let cropper;
function previewImage(event) {
  const file = event.target.files[0];
  if (file) {
    const reader = new FileReader();
    reader.onload = function (e) {
      Swal.fire({
        title: "Crop Gambar",
        html: '<img id="cropPreview" style="max-width: 100%; display: block; margin: auto;">',
        showCancelButton: true,
        confirmButtonText: "Crop",
        cancelButtonText: "Batal",
        didOpen: () => {
          let cropPreview = document.getElementById("cropPreview");
          cropPreview.src = e.target.result;

          // Hapus instance cropper sebelumnya
          if (cropper) cropper.destroy();

          // Inisialisasi cropper baru
          cropper = new Cropper(cropPreview, {
            aspectRatio: 1,
            viewMode: 2,
            autoCropArea: 1,
          });
        },
        preConfirm: () => {
          if (!cropper) return false;

          let canvas = cropper.getCroppedCanvas({
            width: 300,
            height: 300,
          });

          // Tampilkan hasil crop di preview utama
          document.getElementById("preview").src = canvas.toDataURL();
          document.getElementById("preview").style.display = "block";
          document.getElementById("croppedImageInput").value =
            canvas.toDataURL();

          // Hapus cropper setelah selesai
          cropper.destroy();
          cropper = null;

          return true;
        },
      });
    };
    reader.readAsDataURL(file);
  }
}
