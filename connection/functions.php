<?php
include "connection.php";
session_start();

function setAlert($title = '', $text = '', $type = '', $buttons = '')
{
    $_SESSION['pesan'] = [
        'title' => $title,
        'text' => $text,
        'type' => $type,
        'buttons' => $buttons,
    ];
}

if (isset($_SESSION['pesan'])) {
    $title = $_SESSION['pesan']['title'];
    $text = $_SESSION['pesan']['text'];
    $type = $_SESSION['pesan']['type'];
    $buttons = $_SESSION['pesan']['buttons']; 

    echo "
        <div id='msg' data-title='{$title}' data-type='{$type}' data-text='{$text}' data-buttons='{$buttons}'></div>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                let title = $('#msg').data('title');
                let type = $('#msg').data('type');
                let text = $('#msg').data('text');
                let buttons = $('#msg').data('buttons'); // Not used in SweetAlert

                if (text !== '' && type !== '' && title !== '') {
                    Swal.fire({
                        title: title,
                        text: text,
                        icon: type,
                        // buttons can be integrated here if required
                    });
                }
            });
        </script>
    ";

    unset($_SESSION['pesan']);
}

// function tambahDataUser($data)
// {
//     global $conn;
//     $idUnik = uniqid();
//     $nomorPendaftaran = strtoupper($idUnik);
//     $nama = strtolower(htmlspecialchars($data['nama']));
//     $username = htmlspecialchars(stripslashes($data['username']));
//     $password = htmlspecialchars(mysqli_real_escape_string($conn, $data['password']));
//     $password2 = htmlspecialchars(mysqli_real_escape_string($conn, $data['password2']));
//     $status = 'D';
//     $result = mysqli_query(
//         $conn, "SELECT username FROM tb_users WHERE username = '$username'",
//     );

//     if (mysqli_fetch_assoc($result)) {
//         setAlert('gagal', 'Username telah digunakan!', 'error');
//         header('Location: registrasi.php');
//     }
//     if ($password !== $password2) {
//         setAlert('gagal', 'Password dan konfirmasi password tidak sesuai!!', 'error');
//         header('Location: registrasi.php');
//         return false;
//     }

//     //enkrpsi
//     $password = password_hash($password, PASSWORD_DEFAULT);

//     mysqli_query(
//         $conn,
//         "INSERT INTO `users`(`id_peserta`, `nama_peserta`, `username`,
//     `password`,`ps`, `status`) VALUES ('$nomorPendaftaran', '$nama', '$username',
//     '$password', '$password2', '$status')",
//     );
//     return mysqli_affected_rows($conn);
// }

/*$conn = mysqli_connect("simpaten_db","root","kicky123","db_archivio");*/
// include "connect.php"; // Pastikan nama file sesuai
// function query($query){
// 	global $conn;
// 	$result = mysqli_query($conn,$query);
// 	$rows =[];
// 	while ($row = mysqli_fetch_assoc($result)) {
// 		$rows[]= $row;
// 	}
// 	return $rows;
// }
// function tambah($surat) {
// 	global $conn;
// 	$kode = $surat["kode_surat"];
// 	$waktu = $surat["waktu_masuk"];
// 	$nomor = $surat["nomor_surat"];
// 	$tanggal = $surat["tanggal_surat"];
//     $perihal = $surat["perihal"];
//     $pengirim = $surat["pengirim"];
//     $kepada = $surat["kepada"];
// 	$query = "INSERT INTO surat_masuk VALUES ('$kode','$waktu','$nomor','$tanggal','$perihal','$pengirim','$kepada')";
// 	mysqli_query($conn, $query);
// 	return mysqli_affected_rows($conn);
// }
// function ubah($surat) {
//     global $conn;

//     $kode_surat = htmlspecialchars($surat["kode_surat"]);
//     $waktu_masuk = htmlspecialchars($surat["waktu_masuk"]);
//     $nomor_surat = htmlspecialchars($surat["nomor_surat"]);
//     $tanggal_surat = htmlspecialchars($surat["tanggal_surat"]);
//     $perihal = htmlspecialchars($surat["perihal"]);
//     $pengirim = htmlspecialchars($surat["pengirim"]);
//     $kepada = htmlspecialchars($surat["kepada"]);

//     $query = "UPDATE surat_masuk SET 
//               waktu_masuk = '$waktu_masuk',
//               nomor_surat = '$nomor_surat',
//               tanggal_surat = '$tanggal_surat',
//               perihal = '$perihal',
//               pengirim = '$pengirim',
//               kepada = '$kepada'
//               WHERE kode_surat = '$kode_surat'";

//     $result = mysqli_query($conn, $query);

//     if (!$result) {
//         die("Query Error: " . mysqli_error($conn));
//     }

//     return mysqli_affected_rows($conn);
// }

// function hapus($kode){
// 	global $conn;
// 	mysqli_query($conn, "DELETE FROM surat_masuk WHERE kode_surat=$kode");
// 	return mysqli_affected_rows($conn);
// }
// function cari($keyword){
// $query = "SELECT * FROM surat_masuk WHERE perihal LIKE '$keyword' ";
// return query($query);
// }
