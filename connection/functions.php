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
    $buttons = $_SESSION['pesan']['buttons']; // Belum digunakan dalam SweetAlert

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

function tambahDataUser($data)
{
    global $conn;
    $idUnik = uniqid();
    $nomorPendaftaran = strtoupper($idUnik);
    $nama = strtolower(htmlspecialchars($data['nama']));
    $username = htmlspecialchars(stripslashes($data['username']));
    $password = htmlspecialchars(mysqli_real_escape_string($conn, $data['password']));
    $password2 = htmlspecialchars(mysqli_real_escape_string($conn, $data['password2']));
    $status = 'D';
    $result = mysqli_query(
        $conn, "SELECT username FROM tb_users WHERE username = '$username'",
    );

    if (mysqli_fetch_assoc($result)) {
        setAlert('gagal', 'Username telah digunakan!', 'error');
        header('Location: registrasi.php');
    }
    if ($password !== $password2) {
        setAlert('gagal', 'Password dan konfirmasi password tidak sesuai!!', 'error');
        header('Location: registrasi.php');
        return false;
    }

    //enkrpsi
    $password = password_hash($password, PASSWORD_DEFAULT);

    mysqli_query(
        $conn,
        "INSERT INTO `tb_users`(`id_peserta`, `nama_peserta`, `username`,
    `password`,`ps`, `status`) VALUES ('$nomorPendaftaran', '$nama', '$username',
    '$password', '$password2', '$status')",
    );
    return mysqli_affected_rows($conn);
}