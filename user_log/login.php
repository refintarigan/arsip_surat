<?php
 include "../connection/functions.php";
 // Cek apakah pengguna sudah login
if(isset($_SESSION['id_user'])) {
    setAlert('Gagal!', 'Kamu sudah login, Selamat menggunakan sistem ini', 'success');
    header("Location: ../index.php");
    exit();
}
 $password = password_hash("refin2910", PASSWORD_DEFAULT);
//  mysqli_query($conn, "INSERT INTO users VALUE('', 'username', '$password', 'role', 'nama', 'foto')");
//  die();
?>
<!DOCTYPE html>
<html>
<head>
	<?php include "../component/css.php"; ?>

    <link href="../assets/css/login.css" rel="stylesheet">
	<title>LOGIN</title>
</head>
<body>
	<section class="login">
    <div class="container">
        <div class="row p-2 justify-content-center">
            <div class="col-md-6 d-flex align-items-center">
                <div class="card shadow border-radius">
                    <div class="card-body">
                        <form class="p-3" action="proses.php" method="post">
                            <div class="card-body">
                                <div class="logo">
                                    <img src="../assets/img/logoo.png" alt="Logo Archivio" width="60%">
                                </div>
                                <h4 class="text-center text-bold">ARCHIVIO</h4>
                            </div>
                            <h5 class="text-center">SILAHKAN LOGIN</h5>
                            <div class="card my-3 card-login iw">
                                  
                               </div>
                            <label class="mb-3" for="username">Username</label>
                            <input class="form-control mb-3 invalid" type="text" name="username" id="username" autocomplete="off" required>

                            <label class="mb-3" for="password">Password</label>
                            <input class="form-control mb-3" type="password" name="password" id="password" required autocomplete="off">
                            <button type="submit" class="btn btn-primary mt-2" name="login"> Login <i class="fa fa-arrow-right"></i></button>
                      <a href="../Icon.php">Back</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
</body>
	<?php include "../component/js.php"; ?>
</html>

