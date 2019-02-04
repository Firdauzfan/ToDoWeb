<?php
  session_start();
  // Cek Login Apakah Sudah Login atau Belum
  if (!isset($_SESSION['ID'])){
    header("location: index.php");
  }else if ($_SESSION['username']!='admin'){
    header('location:todo.php');
  }

  $submit_id = $_GET['id'];

	require_once 'app/init.php';

  $usersQuery = $db->prepare("
    SELECT * FROM users Where username != 'admin' AND deleted_status='0'
  ");

  $usersQuery->execute();

  $users = $usersQuery->rowCount() ? $usersQuery : [];

  $usersselfQuery = $db->prepare("
    SELECT * FROM users Where id_pegawai= :id
  ");

  $usersselfQuery->execute([
    'id' => $submit_id
  ]);

  $usersself = $usersselfQuery->rowCount() ? $usersselfQuery : [];
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>VIO To Do List | Dashboard</title>

	<link href="http://fonts.googleapis.com/css?family=Shadows+Into+Light+Two" rel="stylesheet">
	<link href="http://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">

  <link rel="stylesheet" href="<?php testParsing(); ?>">
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <?php
  include('scriptcss.php')
  ?>

</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
<?php
include('header.php');
 ?>

<?php
include('sidebar.php');
 ?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="list">
        <h1 class="header">Liat Project => <a href="employeepro.php?id=<?php echo $submit_id; ?>">Liat Project</a> </h1>
        <h1 class="header">Liat To Do List => <a href="employee.php?id=<?php echo $submit_id; ?>">Liat To Do list</a> </h1>

      </div>
    </section>

    <!-- Main content -->
    <section class="content">

    <div class="content-absolute">

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php
  include('footer.php');
   ?>

</div>

</body>
</html>
