<?php
include "../connection/functions.php";
cekLogin("../user_log/login.php");
$surat_list = getAllSurat($conn);

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
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm">
            <h1 class="m-0 text-dark">Arsip Surat</h1>
          </div>
        </div>
      </div>
    </div>
    <!-- /.content-header -->

<section class="content">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="card shadow-sm bg-light mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Filter Surat</h5>
                        <div class="row">
                            <div class="col-md-3 mb-2">
                                <select id="filterTahun" class="form-control">
                                    <option value="">Pilih Tahun</option>
                                    <?php
                                        $tahunSekarang = date("Y");
                                        for ($tahun = $tahunSekarang; $tahun >= 2011; $tahun--) {
                                            echo "<option value='$tahun'>$tahun</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-3 mb-2">
                                <select id="filterBulan" class="form-control">
                                    <option value="">Pilih Bulan</option>
                                    <?php
                                    $bulanList = [
                                        "01" => "Januari", "02" => "Februari", "03" => "Maret", "04" => "April",
                                        "05" => "Mei", "06" => "Juni", "07" => "Juli", "08" => "Agustus",
                                        "09" => "September", "10" => "Oktober", "11" => "November", "12" => "Desember"
                                    ];
                                    foreach ($bulanList as $key => $bulan) {
                                        echo "<option value='$key'>$bulan</option>";
                                    }
                                    ?>
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
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped" id="table_id">
                        <thead class="thead-dark">
                            <tr>
                                <th>#</th>
                                <th>Jenis Surat</th>
                                <th>Kode Surat</th>
                                <th>Waktu</th>
                                <th>Nomor Surat</th>
                                <th>Tanggal Surat</th>
                                <th>Perihal</th>
                                <th>Pengirim</th>
                                <th>Kepada</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($surat_list as $surat) { ?>
                                <tr>
                                    <td><?= $i++; ?></td>
                                    <td><?= $surat['jenis']; ?></td>
                                    <td><?= $surat['kode_surat']; ?></td>
                                    <td><?= date('d/m/Y', strtotime($surat['waktu'])); ?></td>
                                    <td><?= $surat['nomor_surat']; ?></td>
                                    <td><?= date('d/m/Y', strtotime($surat['tanggal_surat'])); ?></td>
                                    <td><?= $surat['perihal']; ?></td>
                                    <td><?= $surat['pengirim']; ?></td>
                                    <td><?= $surat['kepada']; ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
  </div>
</div>
</div>
</div> 

<?php include "../component/js.php"; ?>
<script src="<?= $base_url; ?>assets\js\filter-arsip-config.js"></script>
</body>
</html>