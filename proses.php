<?php
session_start();
include "connect.php"; // Pastikan nama file sesuai

if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = md5($_POST['password']); // Hash password dengan MD5

    // Query untuk mencari username dan password
    $query = "SELECT * FROM login WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        // Set session login
        $_SESSION['stat_login'] = true;
        $_SESSION['id_admin'] = $row['id_admin'];

        echo "<script>alert('Login berhasil!');</script>";
        echo "<script>window.location.href = 'dashboard.php';</script>";
        exit();
    } else {
        echo "<script>alert('Username atau Password salah, Silahkan Coba lagi!');</script>";
        echo "<script>window.location.href = 'login.php';</script>";
        exit();
    }
}
?>