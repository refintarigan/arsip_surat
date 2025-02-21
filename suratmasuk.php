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
    <style>
        * {
            box-sizing: border-box;
            margin: auto;
            padding: 0;
        }
        input{
            padding: 3px;
            width: 60%;
        }
        table{
            width: 100%;
            border: 3px solid black;
            margin-top: 10px;
            font-size: 12pt;
        }
        table th{
            background-color: lightskyblue;
        }
        table th, table td {
            border: 2px solid black;
        }
        body {
            font-family: "Times New Roman", serif;
            line-height: 1.6;
            background-color: #f0f0f0;
            color: #000;
        }

        .header {
            background-color: lightskyblue;
            text-align: center;
            padding: 10px;
        }

        .header h1 {
            margin: 0;
            font-size: 2.5rem;
            color: black;
        }

        .menu {
            float: left;
            width: 12%;
            background-color: navy;
            padding: 10px 0;
            height: 69vh;
            color: white;
        }

        .menu a {
            display: block;
            padding: 10px;
            color: white;
            text-decoration: none;
            text-align: center;
            margin: 2px auto;
        }

        .menu a:hover {
            background-color: #0056b3;
        }

        .main {
            float: left;
            width: 88%;
            padding: 20px;
            background-color: white;
            color: black;
            font-size: 13pt;
            text-align: left;
        }

        .bottom {
            margin-top: 20px;
            margin-left: -20px;
            background-color: lightskyblue;
            color: black;
            text-align: center;
            padding: 10px;
            clear: both;
        }

        img {
            display: block;
            margin: 10px auto;
        }

        @media (max-width: 768px) {
            .menu {
                width: 100%;
                height: 100%;
                float: none;
            }

            .menu a {
                width: 100%;
            }

            .main {
                width: 100%;
                float: left;
            }

            .header h1 {
                font-size: 2rem;
            }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <div class="header">
        <img src="logoo.PNG"  width="25%">
        <h2>ARCHIVIO</h2>
    </div>

    <!-- Menu -->
    <div class="menu">
        <a href="dashboard.php">HOME</a>
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
