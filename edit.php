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
			<h1 class="header">Edit To Do List</h1>
      <select name="valueproject" id="projectid" onchange="selectionchange();">
          <option name="projectoption" value="New" >New</option>
          <?php
            $id=$_SESSION['ID'];
            $judul="SELECT project FROM items WHERE user=$id AND delete_status='0' AND parentchild='0'";
            $query2 = $con->query($judul);
            while ($row = $query2->fetch_assoc()) {
              $judul=$row['project'];
              echo "<option name='judul' value='". $judul."'>" . $judul. "</option>\n";
            }

           ?>
      </select>
			<form class="item-add" action="editsubmit.php" method="POST">
        <?php foreach($items as $item): ?>
        <input type="text" name="project" id="projectform" placeholder="Project" class="input" autocomplete="off" required autofocus="autofocus" value="<?php echo parse($item['project']); ?>">
        <input type="text" name="parentchild" id="parenchild" hidden class="input" autocomplete="off" required autofocus="autofocus" value="<?php echo parse($item['parentchild']); ?>">
				<input type="text" name="name" class="input" placeholder="Tulis To Do List" autocomplete="off" required value="<?php echo parse($item['name']); ?>">
        <textarea rows="8" cols="50" name="detail" placeholder="Tulis Detail To Do List" class="input" autocomplete="off" required><?php echo parse($item['detail']); ?></textarea>
        <input type="text" name="kendala" class="input" placeholder="Kendala yang ada atau akan ada" autocomplete="off" required value="<?php echo parse($item['kendala']); ?>">
        <input type="number" min="0" max="100" step="1" name="progress" class="input" placeholder="Total Progress" autocomplete="off" required value="<?php echo parse($item['progress']); ?>">
        <input type="date" class="input" name="due_date" required value="<?php echo $item['due_date']; ?>">
        <input type="hidden" name="iditem" value="<?php echo $item['id']; ?>">
        <?php endforeach; ?>
				<input type="submit" value="Edit" class="submit">
			</form>

		</div>

	</body>
  <script>
  function selectionchange()
    {
        var e = document.getElementById("projectid");
        var str = e.options[e.selectedIndex].value;
        console.log(str);

        if (str !== "New") {
          document.getElementById('projectform').value = str;
          document.getElementById("projectform").readOnly = true;
          document.getElementById('parenchild').value = "1";
          console.log(document.getElementById('parenchild').value);
        }else{
          document.getElementById('projectform').value = " ";
          document.getElementById("projectform").readOnly = false;
          document.getElementById('parenchild').value = "0";
          console.log(document.getElementById('parenchild').value);
        }

    }
    </script>
</html>
