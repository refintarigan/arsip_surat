<?php
include "../../connection/functions.php";
// if (isset($_GET)) {
//     header('Location: ../../error/505.php');
// }

if (isset($_POST["btnTambahSurat"])) {
    if (tambahSuratMasuk($_POST) > 0) {
        setAlert('Berhasil', 'Data berhasil di simpan', 'success');
        header('Location: ../masuk.php');
        exit();
    } else {
        setAlert('Berhasil', 'Data berhasil di simpan', 'success');
        header('Location: ../masuk.php');
        exit();
    }
}


if (isset($_POST['btnEditSurat'])) {
    $id_surat = $_POST['id_surat']; 
    if (editSuratMasuk($_POST) > 0) {
            setAlert('Berhasil', 'Data berhasil di edit', 'success');
            header("Location: ../detail_surat.php?id_surat=$id_surat");
            exit();
        } else {
            setAlert('Gagal', 'Data gagal di edit', 'error');
            header("Location: ../masuk.php?id_surat=$id_surat");
            exit();
        }
}

   //prosess hapus pendaftar
   if (isset($_GET["hapus_surat"])) {
      $id_surat = decode_id("surat_masuk", $_GET["hapus_surat"], "id");
      if (hapusSurat($id_surat) > 0) {
      setAlert("Berhasil", "Data berhasil di hapus", "success");
      header('Location: ../masuk.php'); 
      exit(); 
   } else {
      setAlert("Gagal", "Data gagal di hapus", "error");
      header('Location: ../masuk.php'); 
      exit(); 
   }
  }


