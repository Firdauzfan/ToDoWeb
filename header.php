<header class="main-header">
  <!-- Logo -->
  <?php
  if (isset($_SESSION['nama_log'])) {
    echo '  <a href="#" class="logo">';
  } else {
    echo '  <a href="index.php" class="logo">';
  }
   ?>

    <!-- mini logo for sidebar mini 50x50 pixels -->
    <span class="logo-mini"><b>V</b>T</span>
    <!-- logo for regular state and mobile devices -->
    <span class="logo-lg"><b>VIO</b>ToDo</span>
  </a>
  <!-- Header Navbar: style can be found in header.less -->
  <nav class="navbar navbar-static-top">
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
      <span class="sr-only">Toggle navigation</span>
    </a>
  </nav>
</header>
