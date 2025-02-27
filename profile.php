<?php
include "connection/functions.php";
cekLogin("user_log/login.php");

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <title>PROFILE</title>
    <?php include "component/css.php"; ?>
    <styLe>
        .profile-header {
            background-color: #f8f9fa;
            padding: 20px;
            text-align: center;
        }
        .profile-img {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            border: 3px solid #fff;
            margin-top: -60px;
        }
        .card {
            border: none;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }

    </styLe>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
    <?php include 'component/sidebar.php'; ?>
    <?php include 'component/navbar.php'; ?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm">
            <h1 class="m-0 text-dark">Profile</h1>
          </div>
        </div>
      </div>
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section>
        <div class="container">
            <div class="row justify-content-center" >
                <div class="col-md-5 ">
                    <div class="card">
                        <div class="profile-header">
                            <img src="assets/img/user_profile/<?= $get_userLog['foto'];?>" alt="Profile Image" class="profile-img">
                            <h3 class="mt-3" id="nama"><?= $get_userLog['name'];?></h3>
                            <p class="text-muted" id="username"><?= $get_userLog['username'];?></p>
                        </div>
                        <div class="card-body text-center">
                            <h5 class="text-primary" id="role"><?= $get_userLog['role'];?></h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- /.content -->
  </div>
</div>
</div>
<?php include "component/footer.php"; ?>
</div> 

<?php include "component/js.php"; ?>
</body>
</html>