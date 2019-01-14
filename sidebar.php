<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <ul class="sidebar-menu" data-widget="tree">
      <li class="header">MAIN NAVIGATION</li>

    	<?php foreach($users as $user): ?>
        <li>
          <a href="employee.php?id=<?php echo $user['id_pegawai']; ?>">
            <i class="fa fa-users"></i> <span> <?php echo $user['username']; ?></span>
            <span class="pull-right-container">
            </span>
          </a>

        </li>
        <?php endforeach; ?>
    <li>
          <a href="logout.php">
            <i class="fa fa-cog"></i> <span>Logout</span>
            <span class="pull-right-container">
            </span>
          </a>
        </li>

    </ul>
  </section>
  <!-- /.sidebar -->
</aside>
