<?php
include "../connection/functions.php";
cekLogin("../user_log/login.php");
$surat_masuk = getSuratMasuk($conn);

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <title>Surat Keluar</title>
    <?php include "../component/css.php"; ?>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
    <?php include '../component/sidebar.php'; ?>
    <?php include '../component/navbar.php'; ?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
    <div class="content-header">

</div>
</div>
</div> 

<?php include "../component/js.php"; ?>
</body>
</html>