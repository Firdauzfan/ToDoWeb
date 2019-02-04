<?php
  session_start();
  // Cek Login Apakah Sudah Login atau Belum
  if (!isset($_SESSION['ID'])){
    header("location: index.php");
  }else if ($_SESSION['username']=='admin'){
    header('location:admin.php');
  }

  $itemedit = $_GET['item'];
	require_once 'app/init.php';
  require_once 'app/connect.php';

	$itemsQuery = $db->prepare("
		SELECT name,parentchild, project, detail, kendala, due_date, done, progress, id
		FROM items
		WHERE id = :id
	");

	$itemsQuery->execute([
		'id' => $itemedit
	]);

	$items = $itemsQuery->rowCount() ? $itemsQuery : [];

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>To do list</title>

		<link href="http://fonts.googleapis.com/css?family=Shadows+Into+Light+Two" rel="stylesheet">
		<link href="http://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

		<link rel="stylesheet" href="<?php testParsing(); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
	</head>

	<body>

		<div class="list">
			<h1 class="header">Edit Project</h1>
			<form class="item-add" action="editsubmitpro.php" method="POST">
        <?php foreach($items as $item): ?>
        <input type="text" name="project" id="projectform" placeholder="Project" class="input" autocomplete="off" required autofocus="autofocus" value="<?php echo parse($item['project']); ?>">
        <input type="text" name="projectasli" hidden id="projectform" placeholder="Project" class="input" autocomplete="off" required autofocus="autofocus" value="<?php echo parse($item['project']); ?>">
        <input type="text" name="parentchild" id="parenchild" hidden class="input" autocomplete="off" required autofocus="autofocus" value="0">
				<input type="text" name="name" class="input" placeholder="Tulis Project Detail" autocomplete="off" required value="<?php echo parse($item['name']); ?>">
        <textarea rows="8" cols="50" name="detail" placeholder="Tulis Project Detail To Do" class="input" autocomplete="off" required><?php echo parse($item['detail']); ?></textarea>
        <input type="text" name="kendala" class="input" placeholder="Kendala yang ada atau akan ada" autocomplete="off" required value="<?php echo parse($item['kendala']); ?>">
        <input type="number" min="0" max="100" step="1" name="progress" class="input" placeholder="Total Progress" autocomplete="off" required value="<?php echo parse($item['progress']); ?>">
        <input type="date" class="input" name="due_date" required value="<?php echo $item['due_date']; ?>">
        <input type="hidden" name="iditem" value="<?php echo $item['id']; ?>">
        <?php endforeach; ?>
				<input type="submit" value="Edit" class="submit">
			</form>

		</div>

	</body>

</html>
