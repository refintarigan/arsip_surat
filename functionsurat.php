<?php
$conn = mysqli_connect("localhost","root","","db_archivio");
function query($query){
	global $conn;
	$result = mysqli_query($conn,$query);
	$rows =[];
	while ($row = mysqli_fetch_assoc($result)) {
		$rows[]= $row;
	}
	return $rows;
}
function tambah($surat) {
	global $conn;
	$kode = $surat["kode_surat"];
	$waktu = $surat["waktu_keluar"];
	$nomor = $surat["nomor_surat"];
	$tanggal = $surat["tanggal_surat"];
    $perihal = $surat["perihal"];
    $pengirim = $surat["pengirim"];
    $kepada = $surat["kepada"];
	$query = "INSERT INTO surat_keluar VALUES ('$kode','$waktu','$nomor','$tanggal','$perihal','$pengirim','$kepada')";
	mysqli_query($conn, $query);
	return mysqli_affected_rows($conn);
}
function ubah($surat) {
	global $conn;
	$kode = $surat["kode_surat"];
	$waktu = $surat["waktu_keluar"];
	$nomor = $surat["nomor_surat"];
	$tanggal = $surat["tanggal_surat"];
    $perihal = $surat["perihal"];
    $pengirim = $surat["pengirim"];
    $kepada = $surat["kepada"];
	$query = "UPDATE surat_keluar SET waktu_keluar = '$waktu',nomor_surat = '$nomor', tanggal_surat = '$tanggal', perihal = '$perihal', pengirim='$pengirim',kepada='$kepada' WHERE kode_surat =$kode";
	mysqli_query($conn, $query);
	return mysqli_affected_rows($conn);
}
function hapus($kode){
	global $conn;
	mysqli_query($conn, "DELETE FROM surat_keluar WHERE kode_surat=$kode");
	return mysqli_affected_rows($conn);
}
function cari($keyword){
$query = "SELECT * FROM surat_keluar WHERE perihal LIKE '$keyword' ";
return query($query);
}
?>