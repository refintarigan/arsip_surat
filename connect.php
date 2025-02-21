<?php
$host = "simpaten_db"; 
$username = "root"; 
$password = "kicky123"; 
$db = "db_archivio"; 

$conn = mysqli_connect($host, $username, $password, $db);

// Periksa koneksi
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
