<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>
    <li class="nav-item d-none d-sm-inline-block">
      <a href="<?= $base_url; ?>index.php" class="nav-link">Dashboard</a>
    </li>
  </ul>

 
  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">
    <!-- Messages Dropdown Menu -->
    <li class="nav-item dropdown">
      <a class="nav-link" data-toggle="dropdown" href="#">
        <i class="far fa-user"></i>
      </a>
      <div class="dropdown-menu dropdown-menu-right">
        <a href="<?= $base_url; ?>profile.php" class="dropdown-item">
          <i class="far fa-fw fa-user"></i> Profile
        </a>
        <a href="<?= $base_url; ?>logout.php" class="dropdown-item">
          <i class="fas fa-fw fa-sign-out-alt"></i> Logout
        </a>
      </div>
    </li>
  </ul>
</nav>
<!-- /.navbar -->
 