<?php
require 'functions.php';

if (!isset($_GET['kode_surat'])) {
    echo "<script>alert('Kode surat tidak ditemukan!');document.location.href = 'suratmasuk.php';</script>";
    exit;
}

$kode = $_GET['kode_surat'];

if (hapus($kode) > 0) {
    echo "<script>alert('Data Berhasil dihapus!'); document.location.href = 'suratmasuk.php';</script>";
} else {
    echo "<script>alert('Data Gagal dihapus!'); document.location.href = 'suratmasuk.php';</script>";
}
?>
