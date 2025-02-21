<?php
$host = "localhost"; 
$username = "root"; 
$password = ""; 
$db = "db_archivio"; 

$conn = mysqli_connect($host, $username, $password, $db);

// Periksa koneksi
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
