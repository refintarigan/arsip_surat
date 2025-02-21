<?php
require 'functions.php';

if (!isset($_GET["kode_surat"])) {
    die("Error: Kode surat tidak ditemukan.");
}

$kode = $_GET["kode_surat"];
$srt = query("SELECT * FROM surat_masuk WHERE kode_surat = '$kode'");

if (!$srt || empty($srt)) {
    die("Error: Data surat tidak ditemukan atau query gagal.");
}

$srt = $srt[0]; // Ambil array pertama dari hasil query

if (isset($_POST["submit"])) {
    if (ubah($_POST) > 0) {
        echo "<script>alert('Data Berhasil Diubah'); document.location.href = 'suratmasuk.php';</script>";
    } else {
        echo "<script>alert('Data Gagal Diubah'); document.location.href = 'suratmasuk.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title> Ubah Data </title>
</head>
<body>
    <h3> Ubah Data </h3>
    <form action="" method="POST">
        <table>
            <input type="hidden" name="kode_surat" value="<?= isset($srt["kode_surat"]) ? $srt["kode_surat"] : ''; ?>">
            <tr><td>Waktu Masuk</td><td>:</td><td><input type="datetime-local" name="waktu_masuk" value="<?= isset($srt["waktu_masuk"]) ? $srt["waktu_masuk"] : ''; ?>"></td></tr>
            <tr><td>Nomor Surat</td><td>:</td><td><input type="text" name="nomor_surat" value="<?= isset($srt["nomor_surat"]) ? $srt["nomor_surat"] : ''; ?>"></td></tr>
            <tr><td>Tanggal Surat</td><td>:</td><td><input type="date" name="tanggal_surat" value="<?= isset($srt["tanggal_surat"]) ? $srt["tanggal_surat"] : ''; ?>"></td></tr>
            <tr><td>Perihal</td><td>:</td><td><input type="text" name="perihal" value="<?= isset($srt["perihal"]) ? $srt["perihal"] : ''; ?>"></td></tr>
            <tr><td>Pengirim</td><td>:</td><td><input type="text" name="pengirim" value="<?= isset($srt["pengirim"]) ? $srt["pengirim"] : ''; ?>"></td></tr>
            <tr><td>Kepada</td><td>:</td><td><input type="text" name="kepada" value="<?= isset($srt["kepada"]) ? $srt["kepada"] : ''; ?>"></td></tr>
            
            <tr><td><button type="submit" name="submit">Edit</button><br><a href="suratmasuk.php">Batal</a></td></tr>
        </table>
    </form>
</body>
</html>
