<?php
include "connection/functions.php";
cekLogin("user_log/login.php");


$startYear = date("Y");
$totalYears = 5;
$years = range($startYear, $startYear + $totalYears - 1);

$jumlahSuratMasukTahunan = [];
$jumlahSuratKeluarTahunan = [];

foreach ($years as $year) {
    $jumlahSuratMasukTahunan[$year] = getCountSuratMasukByYear($conn, $year);
    $jumlahSuratKeluarTahunan[$year] = getCountSuratKeluarByYear($conn, $year);
}

$jumlahSuratMasukHarian = getCountSuratMasukByDayInMonth($conn);
$jumlahSuratKeluarHarian = getCountSuratKeluarByDayInMonth($conn);

$jumlahSuratMasukHari = getCountSuratMasukByDay($conn);
$jumlahSuratKeluarHari = getCountSuratKeluarByDay($conn);

$jumlahSurat = jumlahSeluruhSurat();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <title>Dashboard</title>
    <?php include "component/css.php"; ?>
</head>
<body>
<div class="wrapper">
    <?php include 'component/sidebar.php'; ?>
    <?php include 'component/navbar.php'; ?>
    
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-4 stretch-card grid-margin">
                        <div class="card bg-gradient-danger card-img-holder text-white">
                        <div class="card-body">
                            <img src="<?= $base_url; ?>assets/img/circle.svg" class="card-img-absolute" alt="circle-image" />
                            <h4 class="font-weight-normal mb-3">Total Seluruh Surat <i class="fa fa-group fs-24 float-end"></i>
                            </h4>
                            <h2 class="mb-5"><?= $jumlahSurat; ?> Surat</h2>
                            <h6 class="card-text">Update per - <?= date("d M Y"); ?></h6>
                        </div>
                        </div>
                    </div>
                    <div class="col-md-4 stretch-card grid-margin">
                        <div class="card bg-gradient-danger card-img-holder text-white">
                        <div class="card-body">
                            <img src="<?= $base_url; ?>assets/img/circle.svg" class="card-img-absolute" alt="circle-image" />
                            <h4 class="font-weight-normal mb-3">Jumlah Surat Masuk <i class="fa fa-group fs-24 float-end"></i>
                            </h4>
                            <h2 class="mb-5"><?= mysqli_num_rows(getSuratMasuk()); ?> surat</h2>
                            <h6 class="card-text">Update per - <?= date("d M Y"); ?></h6>
                        </div>
                        </div>
                    </div>
                    <div class="col-md-4 stretch-card grid-margin">
                        <div class="card bg-gradient-danger card-img-holder text-white">
                        <div class="card-body">
                            <img src="<?= $base_url; ?>assets/img/circle.svg" class="card-img-absolute" alt="circle-image" />
                            <h4 class="font-weight-normal mb-3">Jumlah Surat Keluar <i class="fa fa-group fs-24 float-end"></i>
                            </h4>
                            <h2 class="mb-5"><?= mysqli_num_rows(getSuratKeluar()); ?> surat</h2>
                            <h6 class="card-text">Update per - <?= date("d M Y"); ?></h6>
                        </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="card shadow">
                            <div class="card-header">
                                <h5 class="card-title">Surat Hari Ini</h5>
                            </div>
                            <div class="card-body">
                                <canvas id="chartPie"></canvas>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="card shadow">
                            <div class="card-header">
                                <h5 class="card-title">Surat Bulan Ini</h5>
                            </div>
                            <div class="card-body">
                                <canvas id="chartBarMonth"></canvas>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="card shadow">
                            <div class="card-header">
                                <h5 class="card-title">Surat Tahunan</h5>
                            </div>
                            <div class="card-body">
                                <canvas id="chartBarYear"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include "component/js.php"; ?>

<script>
// CHART PIE - Surat Harian
var ctxPie = document.getElementById('chartPie').getContext('2d');
new Chart(ctxPie, {
    type: 'pie',
    data: {
        labels: ['Surat Masuk', 'Surat Keluar'],
        datasets: [{
            data: [<?= $jumlahSuratMasukHari ?>, <?= $jumlahSuratKeluarHari ?>],
            backgroundColor: ['#007bff', '#dc3545']
        }]
    }
});

// CHART BAR - Surat Bulanan
var ctxBarMonth = document.getElementById('chartBarMonth').getContext('2d');
var tanggal = [...Array(31).keys()].map(i => i + 1);
var jumlahSuratMasukHarian = <?= json_encode($jumlahSuratMasukHarian) ?>;
var jumlahSuratKeluarHarian = <?= json_encode($jumlahSuratKeluarHarian) ?>;

new Chart(ctxBarMonth, {
    type: 'bar',
    data: {
        labels: tanggal,
        datasets: [{
            label: 'Surat Masuk',
            data: jumlahSuratMasukHarian,
            backgroundColor: '#28a745'
        }, {
            label: 'Surat Keluar',
            data: jumlahSuratKeluarHarian,
            backgroundColor: '#ffc107'
        }]
    },
    options: {
        scales: {
            y: { beginAtZero: true }
        }
    }
});

// CHART BAR - Surat Tahunan
var years = <?= json_encode(array_keys($jumlahSuratMasukTahunan)) ?>;
var jumlahSuratMasuk = <?= json_encode(array_values($jumlahSuratMasukTahunan)) ?>;
var jumlahSuratKeluar = <?= json_encode(array_values($jumlahSuratKeluarTahunan)) ?>;

var ctxBarYear = document.getElementById('chartBarYear').getContext('2d');
new Chart(ctxBarYear, {
    type: 'bar',
    data: {
        labels: years,
        datasets: [{
            label: 'Surat Masuk',
            data: jumlahSuratMasuk,
            backgroundColor: '#17a2b8'
        }, {
            label: 'Surat Keluar',
            data: jumlahSuratKeluar,
            backgroundColor: '#ff5733'
        }]
    },
    options: { scales: { y: { beginAtZero: true } } }
});
</script>

</body>
</html>
