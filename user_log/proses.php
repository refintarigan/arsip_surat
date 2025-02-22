<?php
if (!$_POST || !$_GET) {
  header('Location: ../error/505.php');
}

include '../connection/functions.php';

if(isset($_POST["daftar"])) {
  if(tambahDataUser($_POST) > 0 ) {
    setAlert("Akun Berhasil Dibuat", "Silahkan Login Mengunakan Username Dan Password Yang Kamu Daftarkan", "success");
    header('Location: login.php');
    exit();       
  }else {
    setAlert("Akun Berhasil Dibuat", "Silahkan Login Mengunakan Username Dan Password Yang Kamu Daftarkan", "success");
    header('Location: registrasi.php');
    exit();  
  }
}


if(isset($_POST["login"])) {
  $username = mysqli_real_escape_string($conn, $_POST["username"]);
  $password = mysqli_real_escape_string($conn, strtolower($_POST["password"]));

  $result = mysqli_query($conn, "SELECT * FROM tb_users WHERE username = '$username'");

  if(mysqli_num_rows($result) === 1) {
      $row = mysqli_fetch_assoc($result);
      if(password_verify($password, $row["password"])) {
          $_SESSION['id_peserta'] = $row['id_peserta'];
          
        setAlert("Berhasil Login", "Selamat Datang di Website PPDB tamansiswa Lubuk Pakam", "success");
        header('Location: ../home');
        exit(); 
      } else {
        setAlert("Gagal Login", "Password/Username Salah", "error");
        header('Location: login.php');
        exit();  
      }
  } else {
    setAlert("Gagal Login", "Password/Username Salah", "error");
    header('Location: login.php');
    exit();  
  }
}
