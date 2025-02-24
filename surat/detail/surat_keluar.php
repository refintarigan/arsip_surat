<?php
include "../../connection/functions.php";
cekLogin("../../user_log/login.php");

$surat = decode_id('surat_keluar', $_GET['id_surat'], 'id');
if (empty($surat)) {
    setAlert("Gagal", "Data tidak di temukan", "error");
    header("Location: keluar.php");
    exit();
}



?>


<!DOCTYPE html>
<html lang="id">
<head>
    <title>Detail Surat Keluar</title>
    <?php include "../../component/css.php"; ?>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
    <?php include '../../component/sidebar.php'; ?>
    <?php include '../../component/navbar.php'; ?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
    <div class="content-header">
    <section>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg">
                    <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= $base_url; ?>surat/keluar.php">Surat Keluar</a></li>
                        <li class="breadcrumb-item active" >Priview Surat</li>
                    </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>
     <div class="container mt-4">
        <h2 class="mb-4 text-center">Data Surat Keluar</h2>
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>Kode Surat</th>
                        <th>Waktu Keluar</th>
                        <th>Nomor Surat</th>
                        <th>Tanggal Surat</th>
                        <th>Perihal</th>
                        <th>Pengirim</th>
                        <th>Kepada</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?= $surat['kode_surat']; ?></td>
                        <td><?= date('d/m/Y', strtotime($surat['waktu_keluar'])); ?></td>
                        <td><?= $surat['nomor_surat']; ?></td>
                        <td><?= date('d/m/Y', strtotime($surat['tanggal_surat'])); ?></td>
                        <td><?= $surat['perihal']; ?></td>
                        <td><?= $surat['pengirim']; ?></td>
                        <td><?= $surat['kepada']; ?></td>
                        <td>
                            <!-- Tombol Edit -->
                            <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#edit_mail">
                                <i class="fas fa-edit"></i> Ubah
                            </button>

                            <!-- Modal Edit Surat -->
                            <div class="modal fade" id="edit_mail" tabindex="-1" role="dialog" aria-labelledby="edit_mail_label" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <form class="text-left p-3" action="<?= $base_url; ?>surat/proses_data/proses_data_all.php" method="post" enctype="multipart/form-data">
                                        <div class="modal-content shadow-lg rounded">
                                            <!-- Header -->
                                            <div class="modal-header bg-warning text-white">
                                                <h5 class="modal-title" id="edit_mail_label">
                                                    <i class="fas fa-edit"></i> Edit Surat
                                                </h5>
                                                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>

                                            <!-- Body -->
                                            <div class="modal-body">
                                                <div class="container-fluid">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <!-- ID Surat (Hidden) -->
                                                            <input type="hidden" value="<?= encode_id($surat['id']); ?>" name="id_surat" id="id_surat">
                                                            
                                                            <!-- Kode Surat -->
                                                            <div class="form-group">
                                                                <label for="kode_surat" class="font-weight-bold">Kode Surat</label>
                                                                <input type="text" name="kode_surat" value="<?= $surat['kode_surat']; ?>" class="form-control" id="kode_surat">
                                                            </div>

                                                            <!-- Waktu Keluar -->
                                                            <div class="form-group">
                                                                <label for="waktu_keluar" class="font-weight-bold">Waktu Keluar</label>
                                                                <input type="date" name="waktu_keluar" value="<?= date('Y-m-d', strtotime($surat['waktu_keluar'])); ?>" class="form-control" id="waktu_keluar">
                                                            </div>

                                                            <!-- Nomor Surat -->
                                                            <div class="form-group">
                                                                <label for="nomor_surat" class="font-weight-bold">Nomor Surat</label>
                                                                <input type="text" name="nomor_surat" value="<?= $surat['nomor_surat']; ?>" class="form-control" id="nomor_surat">
                                                            </div>

                                                            <!-- Tanggal Surat -->
                                                            <div class="form-group">
                                                                <label for="tanggal_surat" class="font-weight-bold">Tanggal Surat</label>
                                                                <input type="date" name="tanggal_surat" value="<?= date('Y-m-d', strtotime($surat['tanggal_surat'])); ?>" class="form-control" id="tanggal_surat">
                                                            </div>

                                                        </div>

                                                        <div class="col-md-6">
                                                            <!-- Perihal -->
                                                            <div class="form-group">
                                                                <label for="perihal" class="font-weight-bold">Perihal</label>
                                                                <input type="text" name="perihal" value="<?= $surat['perihal']; ?>" class="form-control" id="perihal">
                                                            </div>

                                                            <!-- Pengirim -->
                                                            <div class="form-group">
                                                                <label for="pengirim" class="font-weight-bold">Pengirim</label>
                                                                <input type="text" name="pengirim" value="<?= $surat['pengirim']; ?>" class="form-control" id="pengirim">
                                                            </div>

                                                            <!-- Kepada -->
                                                            <div class="form-group">
                                                                <label for="kepada" class="font-weight-bold">Kepada</label>
                                                                <input type="text" name="kepada" value="<?= $surat['kepada']; ?>" class="form-control" id="kepada" >
                                                            </div>

                                                            <!-- Upload File -->
                                                            <div class="form-group">
                                                                <label for="file_surat" class="font-weight-bold">Upload Surat (PDF/DOC)</label>
                                                                <input type="file" name="file_surat" class="form-control-file" id="file_surat" accept=".pdf,.doc,.docx">
                                                                <small class="form-text text-muted">Format yang diizinkan: PDF, DOC, DOCX</small>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-12">
                                                            <!-- Preview File -->
                                                            <div class="form-group text-center">
                                                                <label for="file_preview" class="font-weight-bold">Preview File</label>
                                                                <iframe id="file_preview" class="d-none border rounded" width="100%" height="300px"></iframe>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Footer -->
                                            <div class="modal-footer d-flex justify-content-between">
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">
                                                    <i class="fas fa-times"></i> Batal
                                                </button>
                                                <button type="submit" name="btnEditSuratKeluar" class="btn btn-success">
                                                    <i class="fas fa-save"></i> Simpan Perubahan
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <a href="<?= $base_url; ?>surat/proses_data/proses_data_all.php?hapus_surat=<?= encode_id($surat['id']); ?>">
                                <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i> Hapus</button>
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <h3 class="mt-4">Preview File</h3>
        <?php if (empty($surat['lampiran'])) { ?>
            <p>Data file tidak tersedia.</p>
        <?php } else { 
            // Ambil nama file lampiran
            $filePath = $base_url . 'assets/files/surat_masuk/' . $surat['lampiran'];
            $fileExtension = pathinfo($filePath, PATHINFO_EXTENSION);
            
            // Cek apakah file adalah Word (docx/doc)
            $isWordFile = in_array(strtolower($fileExtension), ['doc', 'docx']);
            ?>

            <div class="border p-3 text-center" id="preview-container">
                <?php if ($isWordFile) { ?>
                    <!-- Jika file Word, tampilkan link download -->
                    <p>File tidak dapat ditampilkan, silakan unduh:</p>
                    <a href="../download/surat_masuk.php?id_surat=<?= encode_id($surat['id']); ?>" class="btn btn-primary">Download File</a>
                <?php } else { ?>
                    <!-- Jika bukan file Word (contoh: PDF), tampilkan dalam iframe -->
                    <iframe id="file-preview" class="w-100" style="height: 400px;" src="<?php echo $filePath; ?>"></iframe>
                <?php } ?>
            </div>
        <?php } ?>

    </div>

</div>
</div>

<?php include "../../component/footer.php"; ?>
</div>
<?php include "../../component/js.php"; ?>
   <script>
    $(document).ready(function () {
        let fileUrl = $base_url . "assets/files/surat_masuk/<?php echo $surat['lampiran']; ?>"; 
        $("#file-preview").attr("src", fileUrl).show();
    });
</script>

<!-- Script untuk Preview File -->
<script>
    document.getElementById("file_surat").addEventListener("change", function(event) {
        const file = event.target.files[0];
        if (file && file.type === "application/pdf") {
            const fileURL = URL.createObjectURL(file);
            document.getElementById("file_preview").src = fileURL;
            document.getElementById("file_preview").classList.remove("d-none");
        } else {
            document.getElementById("file_preview").classList.add("d-none");
        }
    });
</script>
</body>
</html>
