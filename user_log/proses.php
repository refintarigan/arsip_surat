<?php
include '../connection/functions.php';

if(isset($_POST["login"])) {
  $username = mysqli_real_escape_string($conn, $_POST["username"]);
  $password = mysqli_real_escape_string($conn, strtolower($_POST["password"]));

  $result = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'");

  if(mysqli_num_rows($result) === 1) {
      $row = mysqli_fetch_assoc($result);
      if(password_verify($password, $row["password"])) {
          $_SESSION['id_user'] = $row['id'];
          
        setAlert("Berhasil Login", "Selamat Datang di Website manajemen surat", "success");
        header('Location: ../index.php');
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
