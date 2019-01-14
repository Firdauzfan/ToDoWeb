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
  $_SESSION['valuejudul'] = $_POST['valuejudul'];
}
 ?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>To Do list</title>

		<link href="http://fonts.googleapis.com/css?family=Shadows+Into+Light+Two" rel="stylesheet">
		<link href="http://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">

		<link rel="stylesheet" href="<?php testParsing(); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
	</head>

	<body>

		<div class="list">
			<h1 class="header">Input To Do List</h1>
      <form action="todo.php" method="post">
          <table border="0">
              <tr>
                  <th>Filter Search</th>
              </tr>
              <tr>
                  <td>Pilih Filter Divisi</td>
                  <td></td>
                  <td>
                      <select name="valuejudul">
                          <option name="judul" value="All">All</option>
                          <?php
                            require_once 'app/connect.php';
                            $id=$_SESSION['ID'];
                            $judul="SELECT name FROM items WHERE user=$id AND delete_status='0'";
                            $query2 = $con->query($judul);
                            while ($row = $query2->fetch_assoc()) {
                              $judul=$row['name'];
                              echo "<option name='judul' value='". $judul."'>" . $judul. "</option>\n";
                            }

                           ?>
                      </select>
                  </td>
              </tr>
              <td>
                  <input type="submit" name="btn-submit" value="Search"/>
              </td>
          </table>
          </form>
      <?php
      $sqlitems = "SELECT id, name, detail, kendala, due_date, done, progress FROM items WHERE user = :user AND delete_status='0' ";

       if (strlen($_SESSION['valuejudul'])>=1) {
            if ($_SESSION['valuejudul']=='All') {
              $sqlitems .= " ";
            }else {
              $judul=$_SESSION['valuejudul'];
              $sqlitems .= "AND name='$judul' ";
            }
        }
      	$itemsQuery = $db->prepare($sqlitems);

      	$itemsQuery->execute([
      		'user' => $_SESSION['ID']
      	]);

      	$items = $itemsQuery->rowCount() ? $itemsQuery : [];

       ?>
			<?php if(!empty($items)): ?>
			<ul class="items">
				<?php foreach($items as $item): ?>
				<li>
          <h3 class="header">To Do list <?php echo $item['user_name']; ?></h3>
					<span class="item<?php echo $item['done'] ? ' done' : ''?>"> <?php echo parse($item['name']); ?> <br> <br></span>
          <h3 class="header">Detail To Do list</h3>
					<span class="item<?php echo $item['done'] ? ' done' : ''?>"> <?php echo parse($item['detail']); ?> <br> <br></span>
          <h3 class="header">Kendala yang Ada atau Akan Ada</h3>
          <span class="item<?php echo $item['done'] ? ' done' : ''?>"> <?php echo parse($item['kendala']); ?> <br> <br></span>
          <h3 class="header">Progress</h3>
          <span class="item<?php echo $item['done'] ? ' done' : ''?>"> <?php echo parse($item['progress']); ?> <br> <br></span>
          <h3 class="header">Due Date</h3>
          <span class="item<?php echo $item['done'] ? ' done' : ''?>"> <?php echo parse($item['due_date']); ?> <br> <br></span>
					<a class="delete-button" href="mark.php?as=delete&item=<?php echo $item['id']; ?>">Delete</a>
          <a class="edit-button" href="edit.php?item=<?php echo $item['id']; ?>">Edit</a>
					<?php if(!$item['done']): ?>
						<a class="done-button" href="mark.php?as=done&item=<?php echo $item['id']; ?>">Mark as done</a>
					<?php else: ?>
						<a class="undone-button" href="mark.php?as=undone&item=<?php echo $item['id']; ?>">Mark as undone</a>
					<?php endif; ?>
				</li>
				<?php endforeach; ?>
			</ul>
			<?php else: ?>
				<p>You haven't added any items yet.</p>
			<?php endif; ?>
      <br>
      <p>Input New To Do List</p>
			<form class="item-add" action="add.php" method="POST">
				<input type="text" name="name" placeholder="Tulis To Do List" class="input" autocomplete="off" required>
        <input type="text" name="detail" placeholder="Tulis Detail To Do List" class="input" autocomplete="off" required>
        <input type="text" name="kendala" placeholder="Kendala yang ada atau akan ada" class="input" autocomplete="off" required>
        <input type="number" min="0" max="100" step="1" name="progress" placeholder="Total Progress" class="input" autocomplete="off" required>
        <input type="date" class="input" name="due_date" required>
				<input type="submit" value="Add" class="submit">
        <a href="logout.php" class="btn btn-default btn-flat">Logout</a>
			</form>

		</div>

	</body>

</html>
