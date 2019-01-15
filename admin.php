<?php
  session_start();
  // Cek Login Apakah Sudah Login atau Belum
  if (!isset($_SESSION['ID'])){
    header("location: index.php");
  }else if ($_SESSION['username']!='admin'){
    header('location:todo.php');
  }

	require_once 'app/init.php';

	$itemsQuery = $db->prepare("
		SELECT id, name,user_name, kendala, due_date, done,progress,detail
		FROM items WHERE delete_status='0'
	");

  $itemsQuery->execute();

	$items = $itemsQuery->rowCount() ? $itemsQuery : [];

  $usersQuery = $db->prepare("
    SELECT * FROM users Where username != 'admin'
  ");

  $usersQuery->execute();

  $users = $usersQuery->rowCount() ? $usersQuery : [];
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
  			<h1 class="header">Input To Do List</h1>

  			<?php if(!empty($items)): ?>
  			<ul class="items">
  				<?php foreach($items as $item): ?>

  				<li>
            <h3 class="header">To Do list <?php echo $item['user_name']; ?></h3>
            <span class="item<?php echo $item['done'] ? ' done' : ''?>"> <?php echo parse($item['name']); ?> <br> <br></span>
            <h3 class="header">Detail To Do list</h3>
            <textarea rows="8" cols="50" class="input <?php echo $item['done'] ? ' done' : ''?>" readonly><?php echo parse($item['detail']); ?> </textarea>
            <h3 class="header">Kendala yang Ada atau Akan Ada</h3>
            <span class="item<?php echo $item['done'] ? ' done' : ''?>"> <?php echo parse($item['kendala']); ?> <br> <br></span>
            <h3 class="header">Progress</h3>
            <span class="item<?php echo $item['done'] ? ' done' : ''?>"> <?php echo parse($item['progress']); ?> <br> <br></span>
            <h3 class="header">Due Date</h3>
            <span class="item<?php echo $item['done'] ? ' done' : ''?>"> <?php echo parse($item['due_date']); ?> <br> <br></span>

  				</li>
  				<?php endforeach; ?>
  			</ul>

  			<?php endif; ?>


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
