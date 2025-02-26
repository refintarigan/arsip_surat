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


function getSuratKeluar() 
{
    global $conn;
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
function getSuratMasuk() 
{
    global $conn;
    $query = "SELECT * FROM surat_masuk";
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

function get_userLog($id) {
    global $conn;
    $query = "SELECT * FROM users WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    return mysqli_fetch_assoc($result);
}


function saveUser($data)
{
    global $conn;
    global $base_url;

    $nama = strtolower(htmlspecialchars($data['nama']));
    $username = htmlspecialchars(stripslashes($data['username']));
    $password = htmlspecialchars(mysqli_real_escape_string($conn, $data['password']));
    $password2 = htmlspecialchars(mysqli_real_escape_string($conn, $data['password2']));
    $role = htmlspecialchars($data['role']);

    // Validasi username unik
    $result = mysqli_query($conn, "SELECT username FROM users WHERE username = '$username'");

    if (mysqli_fetch_assoc($result)) {
        setAlert('gagal', 'Username telah digunakan!', 'error');
        header("Location:" . $base_url . "users_manajemen/user_akses.php");
        exit;
    }

    // Validasi password konfirmasi
    if ($password !== $password2) {
        setAlert('gagal', 'Password dan konfirmasi password tidak sesuai!!', 'error');
        header('Location:' . $base_url . 'users_manajemen/user_akses.php');
        exit;
    }

    // Enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    // Proses upload gambar dari Base64
    $fotoPath = NULL;
    if (!empty($data['foto'])) {
        $base64 = $data['foto'];
        list($type, $base64) = explode(';', $base64);
        list(, $base64) = explode(',', $base64);
        $imageData = base64_decode($base64);

        // Nama file unik
        $fileName = 'user_' . time() . '.png';
        $filePath = '../../assets/img/user_profile/' . $fileName;

        // Simpan file
        if (file_put_contents($filePath, $imageData)) {
            $fotoPath = $fileName; // Simpan hanya nama file untuk database
        }
    }

    // Simpan data ke database
    $query = "INSERT INTO users (username, password, role, name, foto) 
              VALUES ('$username', '$password', '$role', '$nama', '$fotoPath')";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function updateUser($data)
{
    global $conn;
    global $base_url;

    $id = htmlspecialchars($data['id']);
    $nama = strtolower(htmlspecialchars($data['nama']));
    $username = htmlspecialchars(stripslashes($data['username']));
    $role = htmlspecialchars($data['role']);
    

    // Update data user ke database
    $query = "UPDATE users SET 
              username = '$username', 
              name = '$nama', 
              role = '$role'
              WHERE id = '$id'";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function hapusUser($id) 
{
    global $conn;
    $id = decode_id("users", $id, "id");

    $query = "DELETE FROM users WHERE id =" . $id['id'];
    mysqli_query($conn, $query);
     if (!empty($id['foto'])) {
        $fileLama = '../../assets/img/user_profile/' . $id['foto'];
        if (file_exists($fileLama)) {
            unlink($fileLama);
        }
    }
    return mysqli_affected_rows($conn);
}

// Fungsi untuk mendapatkan semua surat masuk dan keluar
function getAllSurat($conn) {
    $sql = "SELECT 'Surat Keluar' AS jenis, kode_surat, waktu_keluar AS waktu, nomor_surat, tanggal_surat, perihal, pengirim, kepada, lampiran 
            FROM surat_keluar
            UNION ALL
            SELECT 'Surat Masuk' AS jenis, kode_surat, waktu_masuk AS waktu, nomor_surat, tanggal_surat, perihal, pengirim, kepada, lampiran 
            FROM surat_masuk
            ORDER BY waktu DESC";

    $result = $conn->query($sql);
    return $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
}

function getCountSuratMasukByDay($conn) {
    $query = "SELECT COUNT(*) as total FROM surat_masuk WHERE DATE(tanggal_surat) = CURDATE()";
    $result = mysqli_query($conn, $query);
    return ($result) ? mysqli_fetch_assoc($result)['total'] : 0;
}


function getCountSuratMasukByYear($conn, $year) {
    $query = "SELECT COUNT(*) as total FROM surat_masuk WHERE YEAR(tanggal_surat) = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $year);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    return ($result) ? mysqli_fetch_assoc($result)['total'] : 0;
}

function getCountSuratKeluarByDay($conn) {
    $query = "SELECT COUNT(*) as total FROM surat_keluar WHERE DATE(tanggal_surat) = CURDATE()";
    $result = mysqli_query($conn, $query);
    return ($result) ? mysqli_fetch_assoc($result)['total'] : 0;
}


function getCountSuratKeluarByYear($conn, $year) {
    $query = "SELECT COUNT(*) as total FROM surat_keluar WHERE YEAR(tanggal_surat) = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $year);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    return ($result) ? mysqli_fetch_assoc($result)['total'] : 0;
}




function getCountSuratMasukByDayInMonth($conn) {
    $currentMonth = date('m'); // Bulan saat ini
    $currentYear = date('Y'); // Tahun saat ini
    $data = array_fill(1, 31, 0); // Inisialisasi array dengan 31 angka 0

    $query = "SELECT DAY(tanggal_surat) as day, COUNT(*) as jumlah 
              FROM surat_masuk 
              WHERE MONTH(tanggal_surat) = ? AND YEAR(tanggal_surat) = ? 
              GROUP BY day";
    
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $currentMonth, $currentYear);
    $stmt->execute();
    $result = $stmt->get_result();
    
    while ($row = $result->fetch_assoc()) {
        $data[$row['day']] = $row['jumlah']; // Isi array dengan data dari database
    }

    return array_values($data); // Konversi array agar berformat JSON yang sesuai
}

function getCountSuratKeluarByDayInMonth($conn) {
    $currentMonth = date('m');
    $currentYear = date('Y');
    $data = array_fill(1, 31, 0);

    $query = "SELECT DAY(tanggal_surat) as day, COUNT(*) as jumlah 
              FROM surat_keluar 
              WHERE MONTH(tanggal_surat) = ? AND YEAR(tanggal_surat) = ? 
              GROUP BY day";
    
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $currentMonth, $currentYear);
    $stmt->execute();
    $result = $stmt->get_result();
    
    while ($row = $result->fetch_assoc()) {
        $data[$row['day']] = $row['jumlah'];
    }

    return array_values($data);
}

function jumlahSeluruhSurat() 
{
    global $conn;
    return count(getAllSurat($conn));
}

