<?php
include "connection.php";
session_start();
//timezone
date_default_timezone_set('Asia/Jakarta');
$base_url = "http://localhost/arsip_surat/";

function encode_id($id)
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
        $lampiran = NULL; // Bisa diisi dengan string default
    }

    $query = "INSERT INTO surat_masuk (kode_surat, waktu_masuk, nomor_surat, tanggal_surat, perihal, pengirim, kepada, lampiran) 
              VALUES ('$kode', '$waktu', '$nomor', '$tanggal', '$perihal', '$pengirim', '$kepada', '$lampiran')";

    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}


function lampiran()
{
    if (!isset($_FILES['file_surat']) || $_FILES['file_surat']['error'] === 4) {
        return NULL; // NULL file yang diunggah, tetap lanjut tanpa error
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
    
    // Decode ID dan pastikan hasilnya valid
    $decoded_id = decode_id("surat_masuk", $surat['id_surat'], "id");
    if (!isset($decoded_id["id"])) {
        return -1; // ID tidak valid
    }
    $id = $decoded_id["id"];

    // Validasi & Escape Input
    $kode_surat = htmlspecialchars($surat["kode_surat"]);
    $waktu_masuk = htmlspecialchars($surat["waktu_masuk"]);
    $nomor_surat = htmlspecialchars($surat["nomor_surat"]);
    $tanggal_surat = htmlspecialchars($surat["tanggal_surat"]);
    $perihal = htmlspecialchars($surat["perihal"]);
    $pengirim = htmlspecialchars($surat["pengirim"]);
    $kepada = htmlspecialchars($surat["kepada"]);

    // Panggil editLampiran dan dapatkan nama file baru jika ada
    $lampiran = editLampiran($id);

    // Query update dengan kode_surat dikembalikan
    $query = "UPDATE surat_masuk SET 
              kode_surat = ?, 
              waktu_masuk = ?, 
              nomor_surat = ?, 
              tanggal_surat = ?, 
              perihal = ?, 
              pengirim = ?, 
              kepada = ?";

    // Jika ada file baru, tambahkan kolom lampiran
    $params = [$kode_surat, $waktu_masuk, $nomor_surat, $tanggal_surat, $perihal, $pengirim, $kepada];
    $types = "sssssss";

    if ($lampiran !== NULL) {
        $query .= ", lampiran = ?";
        $params[] = $lampiran;
        $types .= "s";
    }

    $query .= " WHERE id = ?";
    $params[] = $id;
    $types .= "i";

    // Persiapkan query
    if ($stmt = mysqli_prepare($conn, $query)) {
        // Binding parameter secara dinamis
        mysqli_stmt_bind_param($stmt, $types, ...$params);

        // Eksekusi statement
        mysqli_stmt_execute($stmt);
        $affected_rows = mysqli_stmt_affected_rows($stmt);
        mysqli_stmt_close($stmt);
        return $affected_rows;
    } else {
        return -1; // Indikasi gagal eksekusi query
    }
}
function editSuratKeluar($surat) 
{
    global $conn;
    
    // Decode ID dan pastikan hasilnya valid
    $decoded_id = decode_id("surat_keluar", $surat['id_surat'], "id");
    if (!isset($decoded_id["id"])) {
        return -1; // ID tidak valid
    }
    $id = $decoded_id["id"];

    // Validasi & Escape Input
    $kode_surat = htmlspecialchars($surat["kode_surat"]);
    $waktu_masuk = htmlspecialchars($surat["waktu_keluar"]);
    $nomor_surat = htmlspecialchars($surat["nomor_surat"]);
    $tanggal_surat = htmlspecialchars($surat["tanggal_surat"]);
    $perihal = htmlspecialchars($surat["perihal"]);
    $pengirim = htmlspecialchars($surat["pengirim"]);
    $kepada = htmlspecialchars($surat["kepada"]);

    // Panggil editLampiran dan dapatkan nama file baru jika ada
    $lampiran = editLampiran($id);

    // Query update dengan kode_surat dikembalikan
    $query = "UPDATE surat_keluar SET 
              kode_surat = ?, 
              waktu_keluar = ?, 
              nomor_surat = ?, 
              tanggal_surat = ?, 
              perihal = ?, 
              pengirim = ?, 
              kepada = ?";

    // Jika ada file baru, tambahkan kolom lampiran
    $params = [$kode_surat, $waktu_masuk, $nomor_surat, $tanggal_surat, $perihal, $pengirim, $kepada];
    $types = "sssssss";

    if ($lampiran !== NULL) {
        $query .= ", lampiran = ?";
        $params[] = $lampiran;
        $types .= "s";
    }

    $query .= " WHERE id = ?";
    $params[] = $id;
    $types .= "i";

    // Persiapkan query
    if ($stmt = mysqli_prepare($conn, $query)) {
        // Binding parameter secara dinamis
        mysqli_stmt_bind_param($stmt, $types, ...$params);

        // Eksekusi statement
        mysqli_stmt_execute($stmt);
        $affected_rows = mysqli_stmt_affected_rows($stmt);
        mysqli_stmt_close($stmt);
        return $affected_rows;
    } else {
        return -1; // Indikasi gagal eksekusi query
    }
}


function editLampiran($id)
{
    global $conn;
    if (!isset($_FILES['file_surat']) || $_FILES['file_surat']['error'] === 4) {
        return NULL; 
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

    if (!empty($lampiranLama)) {
        $fileLama = '../../assets/files/surat_masuk/' . $lampiranLama;
        if (file_exists($fileLama)) {
            unlink($fileLama);
        }
    }

    if (move_uploaded_file($tmpName, $targetPath)) {
        return $namaFileBaru;
    } else {
        return NULL; 
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

function hapusSuratKeluar($data){
	global $conn;
    $id = $data['id'];
	mysqli_query($conn, "DELETE FROM surat_keluar WHERE id=$id");
    $tmp_file = '../../assets/files/surat_masuk/' . $data['lampiran'];
    unlink($tmp_file);
	return mysqli_affected_rows($conn);
}

function tambahSuratKeluar($data) 
{
    global $conn;

    $kode = strval(htmlspecialchars($data["kode_surat"]));
    $waktu = htmlspecialchars($data["waktu_masuk"]);
    $nomor = htmlspecialchars($data["nomor_surat"]);
    $tanggal = htmlspecialchars($data["tanggal_surat"]);
    $perihal = htmlspecialchars($data["perihal"]);
    $pengirim = htmlspecialchars($data["pengirim"]);
    $kepada = htmlspecialchars($data["kepada"]);

    $lampiran = lampiran();
    if ($lampiran === NULL) {
        $lampiran = NULL;
    }

    $query = "INSERT INTO surat_keluar (kode_surat, waktu_keluar, nomor_surat, tanggal_surat, perihal, pengirim, kepada, lampiran) 
              VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    
    if ($stmt = mysqli_prepare($conn, $query)) {
        mysqli_stmt_bind_param($stmt, "ssssssss", $kode, $waktu, $nomor, $tanggal, $perihal, $pengirim, $kepada, $lampiran);
        mysqli_stmt_execute($stmt);
        $affected_rows = mysqli_stmt_affected_rows($stmt);
        mysqli_stmt_close($stmt);
        return $affected_rows;
    } else {
        return -1; 
    }
}


function getSuratMasuk($conn) {
    $query = "SELECT * FROM surat_keluar";
    $stmt = mysqli_prepare($conn, $query); 

    if ($stmt) {
        mysqli_stmt_execute($stmt); 
        $result = mysqli_stmt_get_result($stmt); 
        return $result;
    } else {
        return false;
    }
}

function cekLogin($url) 
{
    if (!isset($_SESSION['id_user'])) {
        setAlert("Anda belum Login!", "Silahkan melakukan login terlebih dahulu", "error");
        header("Location: $url");
        exit();
    }
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





