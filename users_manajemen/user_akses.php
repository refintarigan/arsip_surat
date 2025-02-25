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
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm">
            <h1 class="m-0 text-dark">Data Admin</h1>
          </div>
          <div class="col-sm text-right">
            <button type="button" data-toggle="modal"
            data-target="#tambah_admin" class="btn btn-primary"><i
            class="fas fa-fw fa-plus"></i> Tambah admin</button>

            <div class="modal fade text-left" id="tambah_admin" tabindex="-1" role="dialog" aria-labelledby="tambah_akun_admin" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <form action="../proses_data/proses_data_all.php" method="post">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="tambah_akun_admin">Tambah
                      user</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" name="nama" required class="form-control" id="nama">
                      </div>
                      <div class="form-group">
                        <label for="usename">Username</label>
                        <input type="text" name="username" required class="form-control" id="username">
                      </div>
                      <div class="form-group">
                        <label for="password">password</label>
                        <input type="password" name="password" required class="form-control" id="password">
                      </div>
                      <div class="form-group">
                        <label for="password2">Konfirmasi password</label>
                        <input type="password" name="password2" required class="form-control" id="password2">
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-fw fa-times"></i> Batal</button>
                      <button type="submit" name="btnTambahAdmin" class="btn btn-primary"><i class="fas fa-fw fa-save"></i> Simpan</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <section class="content">
      <div class="container">
        <div class="row">
          <div class="col-lg">
            <div class="card shadow">
                <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-bordered table-hover table-striped" id="table_id">
                        <thead>
                          <tr>
                            <th>No.</th>
                            <th>Nama</th>
                            <th>Username</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php $i = 1; ?>
                          <?php foreach ($data2 as $dg): ?>
                            <tr>
                              <td><?= $i++; ?></td>
                              <td><?= $dg['nama_admin']; ?></td>
                              <td><?= $dg['username']; ?></td>
                            </tr>
                          <?php endforeach ?>
                        </tbody>
                      </table>
                    </div>
                </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
 <?php include '../include/footer.php'; ?>
</div>

</div> 

<?php include "../component/js.php"; ?>
</body>
</html>