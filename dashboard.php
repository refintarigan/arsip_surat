<?php
session_start();
if (!isset($_SESSION['stat_login'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HOME</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: "Times New Roman", serif;
            background-color: #f0f0f0;
            color: #000;
        }

        .header {
            background-color: white;
            text-align: center;
            padding: 10px;
        }

        .header h1 {
            margin: 0;
            font-size: 2.5rem;
            color: black;
        }

        .menu {
            float: left;
            width: 15%;
            background-color: navy;
            padding: 10px 0;
            height: 100vh;
            color: white;
        }

        .menu a {
            display: block;
            padding: 10px;
            color: white;
            text-decoration: none;
            text-align: center;
            margin: 5px auto;
        }

        .menu a:hover {
            background-color: #0056b3;
        }

        .main {
            float: left;
            width: 85%;
            height: 20%;
            padding: 20px;
            background-color: white;
            color: black;
            font-size: 13pt;
            text-align: justify;
        }

        .chart-container {
            float: left;
            width: 70%;
            margin: 20px auto;
        }

        @media (max-width: 768px) {
            .menu {
                width: 100%;
                height: auto;
                float: none;
            }

            .menu a {
                width: 100%;
            }

            .main {
                width: 50%;
                float: none;
            }

            .header h1 {
                font-size: 2rem;
            }
        }
        .bottom {
            margin-top: 20px;
            margin-left: -20px;
            background-color: lightskyblue;
            color: black;
            text-align: center;
            padding: 10px;
            clear: both;
        }
        canvas{
            max-width: 450px;
        }
    </style>
</head>
<body>

    <!-- Header -->
    <div class="header">
        <img src="logoo.PNG" width="25%">
        <h1>ARCHIVIO</h1>
    </div>

    <!-- Menu -->
    <div class="menu">
        <a href="dashboard.php">HOME</a>
        <a href="suratmasuk.php">SURAT MASUK</a>
        <a href="suratkeluar.php">SURAT KELUAR</a>
        <a href="arsip.php">ARSIP SURAT</a>
        <a href="logout.php">LOGOUT</a>
    </div>

    <!-- Main Content -->
    <div class="main">
        <p>Archivio dapat mencerminkan sistem informasi digital yang berfungsi untuk:<br>
1. Pengarsipan: Menyimpan data atau surat secara sistematis.<br>
2. Manajemen Dokumen: Memudahkan akses dan pelacakan dokumen.<br>
3. Keamanan Informasi: Melindungi data arsip dari kehilangan atau kerusakan.<br>
4. Efisiensi Proses: Mengurangi ketergantungan pada arsip fisik dengan transformasi digital.<br>
Relevansi
Penggunaan nama "Archivio" dalam sebuah aplikasi arsip surat pintar memberikan kesan profesional, elegan, dan modern yang mencerminkan fungsi utama aplikasi sebagai pusat pengelolaan dan pelacakan dokumen secara cerdas dan efisien. Nama ini cocok untuk menggambarkan solusi digital yang handal dalam menangani dokumen penting secara sistematis.</p>
        <br><h2>Grafik Surat Masuk & Keluar Bulan Ini</h2>
        <div class="chart-container">
            <canvas id="grafikSurat" width="20" height="8"></canvas>
        </div>
    </div>

    <script>
    document.addEventListener("DOMContentLoaded", function () {
        var ctx = document.getElementById('grafikSurat').getContext('2d');

        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [], // Akan diisi dari API
                datasets: [
                    {
                        label: 'Surat Masuk',
                        backgroundColor: 'blue',
                        borderColor: 'blue',
                        borderWidth: 1,
                        data: []
                    },
                    {
                        label: 'Surat Keluar',
                        backgroundColor: 'red',
                        borderColor: 'red',
                        borderWidth: 1,
                        data: []
                    }
                ]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Ambil data dari API
        fetch('get_data.php')
            .then(response => response.json())
            .then(data => {
                console.log("Data dari API:", data); // Debugging

                let bulan = [];
                let masuk = [];
                let keluar = [];

                // Proses data masuk
                data.surat_masuk.forEach(item => {
                    bulan.push(item.bulan);
                    masuk.push(parseInt(item.total));
                });

                // Proses data keluar
                data.surat_keluar.forEach(item => {
                    keluar.push(parseInt(item.total));
                });

                // Pastikan panjang array sesuai
                while (keluar.length < bulan.length) {
                    keluar.push(0);
                }

                console.log("Bulan:", bulan);
                console.log("Surat Masuk:", masuk);
                console.log("Surat Keluar:", keluar);

                // Update chart
                myChart.data.labels = bulan;
                myChart.data.datasets[0].data = masuk;
                myChart.data.datasets[1].data = keluar;
                
                setTimeout(() => {
                    myChart.update();
                }, 500);
            })
            .catch(error => console.error("Gagal mengambil data:", error));
    });
    </script>
    <div class="bottom">
        <marquee>&copy; 2025 Copyright Archivio. All rights reserved</marquee>
    </div>

</body>
</html>