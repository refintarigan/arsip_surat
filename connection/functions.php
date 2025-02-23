<?php
include "connection.php";
session_start();
//timezone
date_default_timezone_set('Asia/Jakarta');function encode_id($id)
{
    global $conn;
    $id = mysqli_real_escape_string($conn, $id);
    return uniqid() . hash('sha1', $id);
}

function decode_id($tb, $id, $kolom)
{
    global $conn;
    $id = mysqli_real_escape_string($conn, $id);
    $id = substr($id, -40);
    $get_data = mysqli_query($conn, "SELECT * FROM $tb");

    while ($d = mysqli_fetch_assoc($get_data)) {
        if (hash('sha1', $d[$kolom]) === $id) {
            return $d;
        }
    }

    return null;
}

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

function tambahSuratMasuk($data) 
{
    global $conn;

    $kode = mysqli_real_escape_string($conn, htmlspecialchars($data["kode_surat"]));
    $waktu = mysqli_real_escape_string($conn, htmlspecialchars($data["waktu_masuk"]));
    $nomor = mysqli_real_escape_string($conn, htmlspecialchars($data["nomor_surat"]));
    $tanggal = mysqli_real_escape_string($conn, htmlspecialchars($data["tanggal_surat"]));
    $perihal = mysqli_real_escape_string($conn, htmlspecialchars($data["perihal"]));
    $pengirim = mysqli_real_escape_string($conn, htmlspecialchars($data["pengirim"]));
    $kepada = mysqli_real_escape_string($conn, htmlspecialchars($data["kepada"]));

    // Simpan hasil lampiran hanya jika ada file yang diunggah
    $lampiran = lampiran();
    if ($lampiran === NULL) {
        $lampiran = 'Tidak Ada'; // Bisa diisi dengan string default
    }

    $query = "INSERT INTO surat_masuk (kode_surat, waktu_masuk, nomor_surat, tanggal_surat, perihal, pengirim, kepada, lampiran) 
              VALUES ('$kode', '$waktu', '$nomor', '$tanggal', '$perihal', '$pengirim', '$kepada', '$lampiran')";

    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function lampiran()
{
    if (!isset($_FILES['file_surat']) || $_FILES['file_surat']['error'] === 4) {
        return NULL; // Tidak ada file yang diunggah, tetap lanjut tanpa error
    }

    $namaFile = $_FILES['file_surat']['name'];
    $ukuranFile = $_FILES['file_surat']['size'];
    $tmpName = $_FILES['file_surat']['tmp_name'];

    $ekstensiValid = ['pdf', 'doc', 'docx'];
    $ekstensiFile = pathinfo($namaFile, PATHINFO_EXTENSION);
    $ekstensiFile = strtolower($ekstensiFile);

    if (!in_array($ekstensiFile, $ekstensiValid)) {
        setAlert('File gagal disimpan', 'Format file tidak valid!', 'error');
        header('Location: ../masuk.php');
        exit();
    }

    if ($ukuranFile > 50000000) {
        setAlert('File gagal disimpan', 'Ukuran file terlalu besar!', 'error');
        header('Location: ../masuk.php');
        exit();
    }

    $namaFileBaru = uniqid() . '.' . $ekstensiFile;
    $targetPath = '../../assets/files/surat_masuk/' . $namaFileBaru;

    if (move_uploaded_file($tmpName, $targetPath)) {
        return $namaFileBaru;
    } else {
        return NULL; // Jika gagal menyimpan file, tetap lanjut
    }
}

function editSuratMasuk($surat) 
{
    global $conn;
    $id = decode_id("surat_masuk", $surat['id_surat'], "id")["id"];
    $kode_surat = mysqli_real_escape_string($conn, htmlspecialchars($surat["kode_surat"]));
    $waktu_masuk = mysqli_real_escape_string($conn, htmlspecialchars($surat["waktu_masuk"]));
    $nomor_surat = mysqli_real_escape_string($conn, htmlspecialchars($surat["nomor_surat"]));
    $tanggal_surat = mysqli_real_escape_string($conn, htmlspecialchars($surat["tanggal_surat"]));
    $perihal = mysqli_real_escape_string($conn, htmlspecialchars($surat["perihal"]));
    $pengirim = mysqli_real_escape_string($conn, htmlspecialchars($surat["pengirim"]));
    $kepada = mysqli_real_escape_string($conn, htmlspecialchars($surat["kepada"]));

    // Panggil editLampiran dan dapatkan nama file baru jika ada
    $lampiran = editLampiran($id);

    // Query update
    $query = "UPDATE surat_masuk SET 
              waktu_masuk = '$waktu_masuk',
              nomor_surat = '$nomor_surat',
              tanggal_surat = '$tanggal_surat',
              perihal = '$perihal',
              pengirim = '$pengirim',
              kepada = '$kepada'";

    // Jika ada file baru, tambahkan lampiran ke query
    if ($lampiran !== NULL) {
        $query .= ", lampiran = '$lampiran'";
    }

    $query .= " WHERE id = '$id'";

    $result = mysqli_query($conn, $query);

    if (!$result) {
        die("Query Error: " . mysqli_error($conn));
    }

    return mysqli_affected_rows($conn);
}

function editLampiran($id)
{
    global $conn;
    if (!isset($_FILES['file_surat']) || $_FILES['file_surat']['error'] === 4) {
        return NULL; // Tidak ada file yang diunggah, tetap lanjut tanpa error
    }

    $namaFile = $_FILES['file_surat']['name'];
    $ukuranFile = $_FILES['file_surat']['size'];
    $tmpName = $_FILES['file_surat']['tmp_name'];

    $ekstensiValid = ['pdf', 'doc', 'docx'];
    $ekstensiFile = pathinfo($namaFile, PATHINFO_EXTENSION);
    $ekstensiFile = strtolower($ekstensiFile);

    if (!in_array($ekstensiFile, $ekstensiValid)) {
        setAlert('File gagal disimpan', 'Format file tidak valid!', 'error');
        header('Location: ../masuk.php');
        exit();
    }

    if ($ukuranFile > 50000000) {
        setAlert('File gagal disimpan', 'Ukuran file terlalu besar!', 'error');
        header('Location: ../masuk.php');
        exit();
    }

    // Nama file baru yang unik
    $namaFileBaru = uniqid() . '.' . $ekstensiFile;
    $targetPath = '../../assets/files/surat_masuk/' . $namaFileBaru;

    // Cek apakah file lama ada di database
    $query = "SELECT lampiran FROM surat_masuk WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $lampiranLama);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);

    // Jika ada file lama, hapus dulu sebelum menimpa
    if (!empty($lampiranLama)) {
        $fileLama = '../../assets/files/surat_masuk/' . $lampiranLama;
        if (file_exists($fileLama)) {
            unlink($fileLama);
        }
    }

    // Simpan file baru
    if (move_uploaded_file($tmpName, $targetPath)) {
        return $namaFileBaru;
    } else {
        return NULL; // Jika gagal menyimpan file, tetap lanjut
    }
}

function hapusSurat($data){
	global $conn;
    $id = $data['id'];
	mysqli_query($conn, "DELETE FROM surat_masuk WHERE id=$id");
    $tmp_file = '../../assets/files/surat_masuk/' . $data['lampiran'];
    unlink($tmp_file);
	return mysqli_affected_rows($conn);
}

// function cari($keyword){
// $query = "SELECT * FROM surat_masuk WHERE perihal LIKE '$keyword' ";
// return query($query);
// }

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





