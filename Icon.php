<?php
 include "connection/functions.php";
?>
<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
    <?php include "component/css.php"; ?>
    <link rel="stylesheet" href="<?= $base_url; ?>assets/animate/animate.min.css">
	<style>
        body{
            background-color: black;
            color: white;
        }
	</style>
</head>
<body>
<div class="container">
    <div style="height:100vh;" class="row justify-content-center align-items-center">
        <div class="col-md-8 animate__animated animate__backInDown">
            <a class="link" href="user_log/login.php">
                <img  src="assets/img/logoo.png" width="100%">
            </a>
            <h3 class="text-center">Silahkan Klik Icon di atas !</h3>
        </div>
    </div>
</div>
<?php include "component/js.php"; ?>
</body>
</html>