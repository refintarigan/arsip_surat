<?php
include  "../connection/functions.php";
$file = '../assets/files/surat_keluar/' . decode_id("surat_keluar", $_GET['id_surat'], "id")["lampiran"];

if (!file_exists($file)) {
    die("File tidak ditemukan!");
}

// Pastikan file hanya bisa mengunduh format yang diizinkan
$allowed_extensions = ['doc', 'docx', 'pdf'];
$file_extension = pathinfo($file, PATHINFO_EXTENSION);

if (!in_array(strtolower($file_extension), $allowed_extensions)) {
    die("Akses ditolak!");
}

// Atur header agar file dianggap sebagai unduhan aman
header("Content-Type: application/octet-stream");
header("Content-Disposition: attachment; filename=" . basename($file));
header("Content-Length: " . filesize($file));
readfile($file);
exit;
?>