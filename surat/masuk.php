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
              <div class="container">
        <div class="row mb-2">
          <div class="col-sm">
            <h1 class="m-0 text-dark">Surat Masuk</h1>
          </div>
        </div>
      </div>
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
<section class="content">
  <div class="container">
    <div class="row">
      <div class="col-lg">
        <div class="table-responsive">
          <table class="table table-bordered table-hover table-striped" id="table_id">
            <thead>
              <tr>
                <th>#.</th>
                <th>Kode Surat</th>
                <th>Waktu Masuk</th>
                <th>Nomor Surat</th>
                <th>Tanggal Surat</th>
                <th>Perihal</th>
                <th>Pengirim</th>
                <th>Kepada</th>
                <th>Prihal</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</section>

    <!-- /.content -->
  </div>
</div>
</div>
</div> 
<?php include "../component/infolder/js.php"; ?>
</body>
</html>