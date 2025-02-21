<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HOME</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: "Times New Roman", serif;
            line-height: 1.6;
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
            height: 183vh;
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
            padding: 20px;
            background-color: white;
            color: black;
            font-size: 13pt;
            text-align: justify;
        }

        .bottom {
            background-color: navy;
            color: white;
            text-align: center;
            padding: 10px;
            clear: both;
        }

        img {
            display: block;
            margin: 10px auto;
        }

        @media (max-width: 768px) {
            .menu {
                width: 100%;
                height: 100%;
                float: none;
            }

            .menu a {
                width: 100%;
            }

            .main {
                width: 100%;
                float: none;
            }

            .header h1 {
                font-size: 2rem;
            }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <div class="header">
    <img src="logo.PNG"  width="20%">
    <h1>ARCHIVIO</h1>
    </div>

    <!-- Menu -->
    <div class="menu">
        <a href="dashboard.php">HOME</a>
        <a href="suratmasuk.php">SURAT MASUK</a>
        <a href="suratkeluar.php">SURAT KELUAR</a>
        <a href="arsip.php">ARSIP SURAT</a>
        <a href="login.php">LOGOUT</a>
    </div>

    <!-- Main Content -->
    <div class="main">
    	
        

    <!-- Footer -->
    <div class="bottom">
        &copy; Copyright Archivio
    </div>
</body>
</html>
