<?php
include "../connection/functions.php";
if(!isset($_SESSION['id_user'])) {
    setAlert("Anda belum Login!", "Silahkan melakukan login terlebih dahulu", "error");
    header("Location: user_log/login.php");
    exit();
}

$surat_masuk = mysqli_query($conn, "SELECT * FROM surat_masuk");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <title>Surat Masuk</title>
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
              <div class="container">
        <div class="row mb-2">
          <div class="col-sm">
            <h1 class="m-0 text-dark">Surat Masuk</h1>
          </div>
<div class="col-sm text-right">
    <button type="button" data-toggle="modal" data-target="#add_mail" class="btn btn-primary">
        <i class="fas fa-fw fa-plus"></i> Tambah Surat Masuk
    </button>

    <!-- Modal -->
    <div class="modal fade" id="add_mail" tabindex="-1" role="dialog" aria-labelledby="add_mail_q" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <form class="text-left" action="proses_data/proses_data_all.php" method="post" enctype="multipart/form-data">
                <div class="modal-content shadow-lg rounded">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title" id="add_mail_q">
                            <i class="fas fa-envelope-open-text"></i> Tambah Surat Masuk
                        </h5>
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-6">
                                    <!-- Kode Surat -->
                                    <div class="form-group">
                                        <label for="kode_surat" class="font-weight-bold">Kode Surat</label>
                                        <input type="text" name="kode_surat" required autocomplete="off" class="form-control" id="kode_surat" placeholder="Masukkan Kode Surat">
                                    </div>

                                    <!-- Waktu Masuk -->
                                    <div class="form-group">
                                        <label for="waktu_masuk" class="font-weight-bold">Waktu Masuk</label>
                                        <input type="date" name="waktu_masuk" required autocomplete="off" class="form-control" id="waktu_masuk">
                                    </div>

                                    <!-- Nomor Surat -->
                                    <div class="form-group">
                                        <label for="nomor_surat" class="font-weight-bold">Nomor Surat</label>
                                        <input type="text" name="nomor_surat" required autocomplete="off" class="form-control" id="nomor_surat" placeholder="Masukkan Nomor Surat">
                                    </div>

                                    <!-- Tanggal Surat -->
                                    <div class="form-group">
                                        <label for="tanggal_surat" class="font-weight-bold">Tanggal Surat</label>
                                        <input type="date" name="tanggal_surat" required autocomplete="off" class="form-control" id="tanggal_surat">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <!-- Perihal -->
                                    <div class="form-group">
                                        <label for="perihal" class="font-weight-bold">Perihal</label>
                                        <input type="text" name="perihal" required autocomplete="off" class="form-control" id="perihal" placeholder="Masukkan Perihal">
                                    </div>

                                    <!-- Pengirim -->
                                    <div class="form-group">
                                        <label for="pengirim" class="font-weight-bold">Pengirim</label>
                                        <input type="text" name="pengirim" required autocomplete="off" class="form-control" id="pengirim" placeholder="Masukkan Nama Pengirim">
                                    </div>

                                    <!-- Kepada -->
                                    <div class="form-group">
                                        <label for="kepada" class="font-weight-bold">Kepada</label>
                                        <input type="text" name="kepada" required autocomplete="off" class="form-control" id="kepada" placeholder="Masukkan Tujuan Surat">
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
                                        <iframe id="file_preview" class="d-none" width="100%" height="300px"></iframe>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer d-flex justify-content-between">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">
                            <i class="fas fa-times"></i> Batal
                        </button>
                        <button type="submit" name="btnTambahSurat" class="btn btn-success">
                            <i class="fas fa-save"></i> Simpan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

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


      </div>
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
<section class="content">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <!-- FILTER MENU -->
        <div class="card shadow-sm bg-light mb-4">
          <div class="card-body">
            <h5 class="card-title"></h5>
            <div class="row">
              <div class="col-md-3 mb-2">

                  <select id="filterTahun" class="form-control">
                      <option value="">Pilih Tahun</option>
                      <?php
                          $tahunSekarang = date("Y"); // Ambil tahun saat ini
                          for ($tahun = $tahunSekarang; $tahun >= 2011; $tahun--) {
                              echo "<option value='$tahun'>$tahun</option>";
                          }
                      ?>
                  </select>
              </div>
              <div class="col-md-3 mb-2">
                <select id="filterBulan" class="form-control">
                  <option value="">Pilih Bulan</option>
                  <option value="01">Januari</option>
                  <option value="02">Februari</option>
                  <option value="03">Maret</option>
                  <option value="04">April</option>
                  <option value="05">Mei</option>
                  <option value="06">Juni</option>
                  <option value="07">Juli</option>
                  <option value="08">Agustus</option>
                  <option value="09">September</option>
                  <option value="10">Oktober</option>
                  <option value="11">November</option>
                  <option value="12">Desember</option>
                </select>
              </div>
              <div class="col-md-3 mb-2">
                <input type="date" id="filterTanggal" class="form-control">
              </div>
              <div class="col-md-3 mb-2">
                <input type="text" id="filterNomorSurat" class="form-control" placeholder="Cari Nomor Surat">
              </div>
              <div class="col-md-6 mb-2">
                <input type="text" id="filterPerihal" class="form-control" placeholder="Cari Perihal">
              </div>
              <div class="col-md-6 mb-2 text-right">
                <button id="btnFilter" class="btn btn-primary"><i class="fas fa-filter"></i> Filter</button>
                <button id="btnReset" class="btn btn-secondary"><i class="fas fa-redo"></i> Reset</button>
              </div>
            </div>
          </div>
        </div>
        <!-- TABLE -->
        <div class="table-responsive">
          <table class="table table-bordered table-hover table-striped" id="table_id">
            <thead class="thead-dark">
              <tr>
                <th>#</th>
                <th>Kode Surat</th>
                <th>Waktu Masuk</th>
                <th>Nomor Surat</th>
                <th>Tanggal Surat</th>
                <th>Perihal</th>
                <th>Pengirim</th>
                <th>Kepada</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php $i = 1; ?>
              <?php foreach ($surat_masuk as $surat) { ?>
              <tr>
                <td><?= $i++; ?></td>
                <td><?= $surat['kode_surat']; ?></td>
                <td><?= date('d/m/Y', strtotime($surat['waktu_masuk'])); ?></td>
                <td><?= $surat['nomor_surat']; ?></td>
                <td><?= date('d/m/Y', strtotime($surat['tanggal_surat'])); ?></td>
                <td><?= $surat['perihal']; ?></td>
                <td><?= $surat['pengirim']; ?></td>
                <td><?= $surat['kepada']; ?></td>
                <td>
                  <a href="detail/surat_masuk.php?id_surat=<?= encode_id($surat['id']); ?>" class="btn btn-sm mb-1 btn-info"><i class="fas fa-eye"></i> Detail</a>
                </td>
              </tr>
              <?php }; ?>
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

<?php include "../component/js.php"; ?>
<script>
$(document).ready(function() {
    var table = $('#table_id').DataTable();

    $('#btnFilter').click(function() {
        var tahun = $('#filterTahun').val();
        var bulan = $('#filterBulan').val();
        var tanggal = $('#filterTanggal').val(); // Format: YYYY-MM-DD
        var nomorSurat = $('#filterNomorSurat').val();
        var perihal = $('#filterPerihal').val().toLowerCase();

        // Hapus semua filter sebelumnya
        $.fn.dataTable.ext.search.length = 0;

        $.fn.dataTable.ext.search.push(function(settings, data, dataIndex) {

            var waktuKeluar = data[2] || ''; // Format di tabel: dd/mm/yyyy
            var tanggalSurat = data[4] || ''; // Format di tabel: dd/mm/yyyy
            var perihalSurat = data[5] ? data[5].toLowerCase() : ''; // Perihal dalam lowercase
            var nomorSuratData = data[3] || ''; // Nomor surat di tabel


            // Konversi tanggal dari tabel ke format yang bisa dibandingkan
            function convertTanggal(tanggal) {
                var parts = tanggal.split('/');
                if (parts.length === 3) {
                    return {
                        year: parts[2], 
                        month: parts[1], 
                        day: parts[0] 
                    };
                }
                return { year: '', month: '', day: '' };
            }

            var waktuKeluarParsed = convertTanggal(waktuKeluar);
            var tanggalSuratParsed = convertTanggal(tanggalSurat);

            // Konversi format tanggal input (YYYY-MM-DD) ke format dd/mm/yyyy
            var inputTanggal = '';
            var inputTahun = '';
            var inputBulan = '';

            if (tanggal) {
                var dateParts = tanggal.split('-'); // [YYYY, MM, DD]
                inputTahun = dateParts[0];
                inputBulan = dateParts[1];
                inputTanggal = dateParts[2];
            }

            // Filter berdasarkan tahun, bulan, tanggal
            if ((tahun && waktuKeluarParsed.year !== tahun && tanggalSuratParsed.year !== tahun) ||
                (bulan && waktuKeluarParsed.month !== bulan && tanggalSuratParsed.month !== bulan) ||
                (tanggal && waktuKeluarParsed.day !== inputTanggal && tanggalSuratParsed.day !== inputTanggal) ||
                (nomorSurat && nomorSuratData !== nomorSurat) ||
                (perihal && perihalSurat.indexOf(perihal) === -1)) {
                return false;
            }
            return true;
        });

        table.draw(); // Terapkan filter pada DataTable
    });

    $('#btnReset').click(function() {
        // Kosongkan input filter
        $('#filterTahun, #filterBulan, #filterTanggal, #filterNomorSurat, #filterPerihal').val('');

        // Hapus semua filter yang diterapkan
        $.fn.dataTable.ext.search.length = 0;

        // Reset DataTable ke kondisi awal
        table.search('').columns().search('').draw();
    });
});
</script>
</body>
</html>