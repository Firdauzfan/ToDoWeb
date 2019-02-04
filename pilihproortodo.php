<?php
  session_start();
  // Cek Login Apakah Sudah Login atau Belum
  if (!isset($_SESSION['ID'])){
    header("location: index.php");
  }else if ($_SESSION['username']=='admin'){
    header('location:admin.php');
  }

	require_once 'app/init.php';


?>

<?php
if(isset($_POST['btn-submit'])){
  $_SESSION['valuejudulproject'] = $_POST['valuejudulproject'];
  $_SESSION['valuejudul'] = $_POST['valuejudul'];
}
 ?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>To Do list</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
		<link href="https://fonts.googleapis.com/css?family=PT+Sans+Narrow" rel="stylesheet">

		<link rel="stylesheet" href="<?php testParsing(); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
	</head>

	<body>

		<div class="list">
      <h1 class="header">Input Project => <a href="project.php?id=<?php echo $_SESSION['ID']; ?>">Input Project</a> </h1>
			<h1 class="header">Input To Do List => <a href="todo.php?id=<?php echo $_SESSION['ID']; ?>">Input To Do list</a> </h1>

		</div>

	</body>

</html>
