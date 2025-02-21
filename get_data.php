<?php
include 'connect.php'; // Pastikan file koneksi benar

// Query untuk surat masuk berdasarkan bulan
$queryMasuk = "SELECT DATE_FORMAT(waktu_masuk, '%Y-%m') AS bulan, COUNT(*) AS total 
               FROM surat_masuk 
               GROUP BY bulan 
               ORDER BY bulan";

$resultMasuk = mysqli_query($conn, $queryMasuk);
$dataMasuk = [];
while ($row = mysqli_fetch_assoc($resultMasuk)) {
    $dataMasuk[] = $row;
}

// Query untuk surat keluar berdasarkan bulan
$queryKeluar = "SELECT DATE_FORMAT(waktu_keluar, '%Y-%m') AS bulan, COUNT(*) AS total 
                FROM surat_keluar 
                GROUP BY bulan 
                ORDER BY bulan";

$resultKeluar = mysqli_query($conn, $queryKeluar);
$dataKeluar = [];
while ($row = mysqli_fetch_assoc($resultKeluar)) {
    $dataKeluar[] = $row;
}

// Mengembalikan data dalam format JSON
echo json_encode([
    "surat_masuk" => $dataMasuk,
    "surat_keluar" => $dataKeluar
]);

?>