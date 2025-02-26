<?php
$get_userLog = get_userLog($_SESSION["id_user"]);
?>

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-light-primary elevation-4">
  <!-- Brand Logo -->
  <a href="<?= $base_url; ?>index.php" class="brand-link">
    <img src="<?= $base_url; ?>assets/img/logo.png" alt="Logo" class="brand-image rounded  p-1 bg-white">
    <span class="brand-text font-weight-dark">ARCHIVIO</span>
  </a>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex align-items-center">
      <div class="image">
          <img class="rounded-pill" style="width: 50px; height: 50px;" src="<?= $base_url; ?>assets/img/user_profile/<?= $get_userLog['foto']; ?>" alt="User Image">
      </div>
      <div class="info ml-2">
          <a href="<?= $base_url; ?>index.php" class="d-block font-weight-bold">
              <?= $get_userLog['name']; ?>
          </a>
          <span class="badge badge-success"><?= $get_userLog['role']; ?></span>
      </div>
  </div>


    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
        <li class="nav-item has-treeview menu-open">
          <a href="<?= $base_url; ?>index.php" class="nav-link active">
            <i class="nav-icon fas fa-home"></i>
            <p>
              Home
            </p>
          </a>
        </li>
        
        <li class="nav-item has-treeview">
          <a href="<?= $base_url; ?>#" class="nav-link">
            <i class="nav-icon fa fa-file"></i>
            <p>
              Surat
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="<?= $base_url; ?>surat/masuk.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p> Surat masuk </p>
              </a>
            </li>
          </ul>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="<?= $base_url; ?>surat/keluar.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p> surat keluar</p>
              </a>
            </li>
          </ul>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="<?= $base_url; ?>surat/arsip.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p> surat arsip</p>
              </a>
            </li>
          </ul>
        </li>
        <?php if ($get_userLog['role'] === "admin") { ?>
          <li class="nav-item has-treeview">
            <a href="<?= $base_url; ?>#" class="nav-link">
              <i class="nav-icon fa fa-key"></i>
              <p>
                User Akses
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= $base_url; ?>users_manajemen/user_akses.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p> Akses user</p>
                </a>
              </li>
            </ul>
          </li>
        <?php } ?>
        <li class="nav-item has-treeview">
          <a href="<?= $base_url; ?>#" class="nav-link">
            <i class="nav-icon fa fa-cog"></i>
            <p>
              Pengaturan
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="<?= $base_url; ?>surat/masuk.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p> kop surat</p>
              </a>
            </li>
          </ul>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="<?= $base_url; ?>surat/keluar.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p> </p>
              </a>
            </li>
          </ul>
        </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>
