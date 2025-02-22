<?php
 include "../connection/functions.php";
 var_dump($_SESSION);
//  // Cek apakah pengguna sudah login
// if(!isset($_SESSION['id_log'])) {
//     // Jika sudah login, redirect ke halaman utama atau halaman dashboard
//     header("Location: ../index.php");
//     exit();
// }
 $password = password_hash("user_1", PASSWORD_DEFAULT);
//  mysqli_query($conn, "INSERT INTO users VALUE('', 'user_1', '$password', 'admin', 'user_1')");
//  die();
// mysqli_query($conn, "UPDATE users SET password = '$password' WHERE id = 2911 ");
?>
<!DOCTYPE html>
<html>
<head>
	<?php include "../component/login/css.php"; ?>
	<title>LOGIN</title>
</head>
<body>
	<section class="login">
    <div class="container ">
        <div class="row p-2 justify-content-center ">
            <div class="col-md-6 d-flex align-items-center ">
                <div class="card shadow border-radius">
                    <div class="card-body">
                        <form class="p-3" action="proses.php" method="post">
                            <div class="card-body">
                                <div class="text-center py-3">
                                    <img src="../assets/img/logo_tamsis.png" alt="Logo Tamansiswa" width="40%">
                                    <img src="../assets/img/dispem_logo.png" alt="Logo Tamansiswa" width="40%">
                                </div>
                                <h4 class="text-center">LOGIN</h4>
                            </div>
                            <div class="card my-3 card-login iw">
                                <div class="card-body ">
                                    silahkan login menggunakan username dan password yang anda miliki
                                </div>
                            </div>
                            <label class="mb-3" for="username">Username</label>
                            <input class="form-control mb-3 invalid" type="text" name="username" id="username" autocomplete="off" required>

                            <label class="mb-3" for="password">Password</label>
                            <input class="form-control mb-3" type="password" name="password" id="password" required>

                            <p> 
                                belum memilikin akun? <a href="registrasi.php">Registrasi</a>
                            </p>
                            <button type="submit" class="btn btn-primary mt-2" name="login">Login <i class="fa fa-arrow-right"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
</body>
	<?php include "../component/login/css.php"; ?>
</html>

