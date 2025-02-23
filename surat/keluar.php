<?php
include "../connection/functions.php";
if(!isset($_SESSION['id_user'])) {
    setAlert("Anda belum Login!", "Silahkan melakukan login terlebih dahulu", "error");
    header("Location: user_log/login.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <title>HOME</title>
    <?php include "../component/infolder/css.php"; ?>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
    <?php include '../component/infolder/sidebar.php'; ?>
    <?php include '../component/infolder/navbar.php'; ?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg">
                    <div class="card card-home shadow p-2">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <img src="assets/img/logo2.png" width="100%" alt="">
                                        </div>
                                        <div class="col-md-6">
                                            <img src="assets/img/logo-kominfo.jpg" width="100%" alt="">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <h3 class="text-primary">Selamat datang di aplikasi manajemen surat</h3><hr>
                                    <p>Oleh mahasiswa STMIK PELITA NUSANTARA</p>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
</div>
</div> 
<?php include "../component/infolder/js.php"; ?>
</body>
</html>