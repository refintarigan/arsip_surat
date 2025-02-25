<?php
include "../../connection/functions.php";

if (isset($_POST["btnTambahAdmin"])) {
    if (saveUser($_POST) > 0) {
        setAlert('sukses', 'User berhasil ditambahkan!', 'success');
    } else {
        setAlert('gagal', 'Terjadi kesalahan saat menambahkan user.', 'error');
    }
    header("Location: " . $base_url . "users_manajemen/user_akses.php");
    exit;
}

if (isset($_POST["btnUpdateUser"])) {
    if (updateUser($_POST) > 0) {
        setAlert('sukses', 'Data user berhasil diperbarui!', 'success');
    } else {
        setAlert('gagal', 'Tidak ada perubahan data atau terjadi kesalahan.', 'error');
    }
    header("Location: " . $base_url . "users_manajemen/user_akses.php");
    exit;
}

if (isset($_GET["id"])) {
    if (hapusUser($_GET['id']) > 0) {
        setAlert('sukses', 'Data user berhasil dihapus!', 'success');
    } else {
        setAlert('gagal', 'Tidak ada perubahan data atau terjadi kesalahan.', 'error');
    }
    header("Location: " . $base_url . "users_manajemen/user_akses.php");
    exit;
}

