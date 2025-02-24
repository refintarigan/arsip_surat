<?php
include "connection/functions.php";
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
    <?php include "component/css.php"; ?>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
    <?php include 'component/infolder/sidebar.php'; ?>
    <?php include 'component/navbar.php'; ?>
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
                                            <div class="row mt-4">
                                                <div class="col-md-12">
                                                    <div class="card shadow border-0">
                                                        <div class="card-body">
                                                            <h5 class="card-title text-center">Grafik Surat Masuk dan Surat Keluar Bulan Ini</h5>
                                                            <canvas id="suratChart"></canvas>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
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

<?php include "component/js.php"; ?>
<script>
    const labels = <?php echo json_encode($labels); ?>;
    const dataSuratMasuk = <?php echo json_encode($suratMasuk); ?>;
    const dataSuratKeluar = <?php echo json_encode($suratKeluar); ?>;

    const ctx = document.getElementById('suratChart').getContext('2d');
    const suratChart = new Chart(ctx, {
        type: 'bar', // jenis grafik (bar, line, pie, dll)
        data: {
            labels: labels,
            datasets: [
                {
                    label: 'Surat Masuk',
                    data: dataSuratMasuk,
                    backgroundColor: 'rgba(54, 162, 235, 0.5)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                },
                {
                    label: 'Surat Keluar',
                    data: dataSuratKeluar,
                    backgroundColor: 'rgba(255, 99, 132, 0.5)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                }
            ]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
</body>
</html>