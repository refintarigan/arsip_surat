<?php 
require 'functions.php';
$surat = query("SELECT * FROM surat_masuk");

// Cek apakah tombol cari ditekan
if (isset($_POST["cari"])) {
    $surat = cari($_POST["keyword"]);
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SURAT MASUK</title>
</head>
<body>
    <!-- Header -->
    <div class="header">
        <img src="logoo.PNG"  width="25%">
        <h2>ARCHIVIO</h2>
    </div>

    <!-- Menu -->
    <div class="menu">
        <a href="index.php">HOME</a>
        <a href="suratmasuk.php">SURAT MASUK</a>
        <a href="suratkeluar.php">SURAT KELUAR</a>
        <a href="arsip.php">ARSIP SURAT</a>
        <a href="login.php">LOGOUT</a>
    </div>

    <!-- Main Content -->
    <div class="main">
    <h2>DATA SURAT MASUK</h2>
        <form action="" method="POST">
            <center><input type="text" name="keyword" placeholder="Cari data surat..." autofocus>
            <button type="submit" name="cari">Cari</button></center>
            <button><a href="addsuratmasuk.php">Tambah Data</a></button>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Surat</th>
                    <th>Waktu Masuk</th>
                    <th>Nomor Surat</th>
                    <th>Tanggal Surat</th>
                    <th>Perihal</th>
                    <th>Pengirim</th>
                    <th>Kepada</th>
                    <th>Aksi</th>
                </tr>
            </thead>
                <tbody>
                <?php $i = 1; ?>
                <?php foreach ($surat as $srt) : ?>
                    <tr>
                        <td><?= $i; ?></td>
                        <td><?= $srt["kode_surat"]; ?></td>
                        <td><?= $srt["waktu_masuk"]; ?></td>
                        <td><?= $srt["nomor_surat"]; ?></td>
                        <td><?= $srt["tanggal_surat"]; ?></td>
                        <td><?= $srt["perihal"]; ?></td>
                        <td><?= $srt["pengirim"]; ?></td>
                        <td><?= $srt["kepada"]; ?></td>
                        <td class="action">
                        <a href="editsuratmasuk.php?kode_surat=<?= $srt["kode_surat"]; ?>">Edit</a> ||
                        <a href="hapussuratmasuk.php?kode_surat=<?= $srt['kode_surat']; ?>"onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</a>
                        </td>
                    </tr>
                    <?php $i++; ?>
                <?php endforeach; ?>
            </tbody>
        </table>        

    <!-- Footer -->
    <div class="bottom">
        <marquee>&copy; 2025 Copyright Archivio. All rights reserved</marquee>
    </div>
</body>
</html>
