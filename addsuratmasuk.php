<?php
require 'functions.php';
if (isset($_POST["submit"])) {
	if (tambah($_POST)>0){
		echo "<script>alert('Data Berhasil Ditambahkan');document.location.href = 'suratmasuk.php';</script>";
	} else {
		"<script>alert('Data Gagal Ditambahkan');document.location.href = 'suratmasuk.php';</script>";
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Tambah Data</title>
</head>
<body>
	<body>
		<h3>Tambah Data</h3>
<form action="" method="POST" class="form-control">
	<table>
		<tr>
			<td>Kode Surat</td><td>:</td><td><input type="text" name="kode_surat"></td>
		</tr>
		<tr>
			<td>Waktu Masuk</td><td>:</td><td><input type="datetime-local" name="waktu_masuk"></td>
		</tr>
		<tr>
			<td>Nomor Surat</td><td>:</td><td><input type="text" name="nomor_surat"></td>
		</tr>
        <tr>
			<td>Tanggal Surat</td><td>:</td><td><input type="date" name="tanggal_surat"></td>
		</tr>
		<tr>
			<td>Perihal</td><td>:</td><td><input type="text" name="perihal"></td>
		</tr>
        <tr>
			<td>Pengirim</td><td>:</td><td><input type="text" name="pengirim"></td>
		</tr>
        <tr>
			<td>Kepada</td><td>:</td><td><input type="text" name="kepada"></td>
		</tr>
		<tr>
		<td><button type="submit" name="submit">Tambah</button><br><a href="suratmasuk.php">Batal</a></td></tr>
	</table>
</form>
</body>
</body>
</html>