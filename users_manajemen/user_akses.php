<?php
include "../connection/functions.php";
cekLogin("../user_log/login.php");

$users = mysqli_query($conn, "SELECT * FROM users");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <title>Data Admin</title>
    <?php include "../component/css.php"; ?>
    <link rel="stylesheet" href="<?= $base_url; ?>assets/cropper/cropper.min.css">
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
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambah_admin">
                            <i class="fas fa-fw fa-plus"></i> Tambah admin
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg">
                        <div class="card shadow">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover table-striped" id="table_id">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Foto</th>
                                                <th>Nama</th>
                                                <th>Username</th>
                                                <th>Role</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 1; ?>
                                            <?php foreach ($users as $user): ?>
                                                <tr>
                                                    <td><?= $i++; ?></td>
                                                    <td>
                                                        <img src="<?= $base_url; ?>assets/img/user_profile/<?= $user['foto']; ?>"
                                                             width="45px" alt="foto <?= $user['name']; ?>">
                                                    </td>
                                                    <td><?= $user['name']; ?></td>
                                                    <td><?= $user['username']; ?></td>
                                                    <td><?= $user['role']; ?></td>
                                                    <td>
                                                        <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editUserModal<?= $user['id']; ?>">
                                                            <i class="fas fa-edit"></i> Edit
                                                        </button>
                                                        <!-- Modal Edit User -->
                                                        <div class="modal fade" id="editUserModal<?= $user['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="editUserLabel<?= $user['id']; ?>" aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="editUserLabel<?= $user['id']; ?>">Edit User</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <form action="proses_data/proses_data_all.php" method="POST" enctype="multipart/form-data">
                                                                        <div class="modal-body">
                                                                            <input type="hidden" name="id" value="<?= $user['id']; ?>">

                                                                            <div class="form-group">
                                                                                <label for="nama">Nama</label>
                                                                                <input type="text" name="nama" class="form-control" value="<?= $user['name']; ?>" required>
                                                                            </div>

                                                                            <div class="form-group">
                                                                                <label for="username">Username</label>
                                                                                <input type="text" name="username" class="form-control" value="<?= $user['username']; ?>" required>
                                                                            </div>

                                                                            <div class="form-group">
                                                                                <label for="role">Role</label>
                                                                                <select name="role" class="form-control" required>
                                                                                    <option value="admin" <?= ($user['role'] == 'admin') ? 'selected' : ''; ?>>Admin</option>
                                                                                    <option value="pegawai" <?= ($user['role'] == 'pegawai') ? 'selected' : ''; ?>>Pegawai</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                                            <button type="submit" name="btnUpdateUser" class="btn btn-primary">Simpan Perubahan</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>


                                                        <button class="btn btn-danger btn-sm" onclick="hapusAdmin('<?= encode_id($user['id']); ?>')">
                                                            <i class="fas fa-trash"></i> Hapus
                                                        </button>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
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

    <?php include '../component/footer.php'; ?>
</div>

<!-- Modal Tambah Admin -->
<div class="modal fade" id="tambah_admin" tabindex="-1" role="dialog" aria-labelledby="tambah_akun_admin" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form action="proses_data/proses_data_all.php" method="post" enctype="multipart/form-data">
            <div class="modal-content shadow-lg rounded-lg border-0">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title"><i class="fas fa-user-plus"></i> Tambah Admin</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body p-4">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nama">Nama Lengkap</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    </div>
                                    <input type="text" name="nama" required class="form-control" id="nama" placeholder="Masukkan nama">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="username">Username</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-user-tag"></i></span>
                                    </div>
                                    <input type="text" name="username" required class="form-control" id="username" placeholder="Masukkan username">
                                </div>
                            </div>

                            <!-- Tambahan Input File dan Preview -->
                             <div class="form-group">
                                <label for="foto">Pilih Gambar</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="foto" accept="image/*" onchange="previewImage(event)" required>
                                    <label class="custom-file-label" for="foto">Choose file...</label>
                                </div>
                            </div>

                            <!-- Preview Gambar -->
                            <div class="text-center mt-3">
                                <img id="preview" src="https://via.placeholder.com/150" class="img-thumbnail" style="display: none;">
                            </div>
                            
                            <!-- hasil Gambar -->
                            <input type="hidden"  name="foto" id="croppedImageInput">

                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="role">Pilih Role</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-user-cog"></i></span>
                                    </div>
                                    <select name="role" class="form-control" id="role" required>
                                        <option value="" disabled selected>Pilih role</option>
                                        <option value="admin">Admin</option>
                                        <option value="pegawai">Pegawai</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                    </div>
                                    <input type="password" name="password" required class="form-control" id="password" placeholder="Masukkan password">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="password2">Konfirmasi Password</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-check-circle"></i></span>
                                    </div>
                                    <input type="password" name="password2" required class="form-control" id="password2" placeholder="Masukkan ulang password">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">
                        <i class="fas fa-times"></i> Batal
                    </button>
                    <button type="submit" name="btnTambahAdmin" class="btn btn-primary">
                        <i class="fas fa-save"></i> Simpan
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>





<?php include "../component/js.php"; ?>
<script src="<?= $base_url; ?>assets/cropper/cropper.min.js"></script>
<script src="<?= $base_url; ?>assets/js/cropper-config.js"></script>
<script src="<?= $base_url; ?>assets/cropper/cropper.min.js"></script>
</body>
</html>