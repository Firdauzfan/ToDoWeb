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
			<h1 class="header">Input To Do List => <a href="graphemployee.php?id=<?php echo $_SESSION['ID']; ?>"><?php echo $_SESSION['username']; ?></a> </h1>
      <form action="todo.php" method="post">
          <table border="0">
              <tr>
                  <th>Filter Search</th>
              </tr>
              <tr>
                  <td>Pilih Filter Project</td>
                  <td></td>
                  <td>
                      <select name="valuejudulproject">
                          <option name="judulproject" value="All">All</option>
                          <?php
                            require_once 'app/connect.php';
                            $id=$_SESSION['ID'];
                            $judul="SELECT project FROM items WHERE user=$id AND delete_status='0' AND parentchild='0'";
                            $query2 = $con->query($judul);
                            while ($row = $query2->fetch_assoc()) {
                              $judul=$row['project'];
                              echo "<option name='judulproject' value='". $judul."'>" . $judul. "</option>\n";
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
      <form action="todo.php" method="post">
          <table border="0">
              <tr>
                  <td>Pilih Filter To Do List</td>
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
      $sqlitems = "SELECT id,project, name, detail, kendala, due_date, done, progress FROM items WHERE user = :user AND delete_status='0' ";

       if (strlen($_SESSION['valuejudul'])>=1 || strlen($_SESSION['valuejudulproject'])>=1) {
            if ($_SESSION['valuejudul']=='All' || $_SESSION['valuejudulproject']=='All') {
              $sqlitems .= " ";
            }else {
              if ($_SESSION['valuejudul']) {
                $judul=$_SESSION['valuejudul'];
                $sqlitems .= "AND name='$judul' ";
              }else if ($_SESSION['valuejudulproject']) {
                $judul=$_SESSION['valuejudulproject'];
                $sqlitems .= "AND project='$judul' ";
              }

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
          <h3 class="header">Project</h3>
          <span class="item<?php echo $item['done'] ? ' done' : ''?>"> <?php echo parse($item['project']); ?> <br> <br></span>
          <h3 class="header">To Do list <?php echo $item['user_name']; ?></h3>
					<span class="item<?php echo $item['done'] ? ' done' : ''?>"> <?php echo parse($item['name']); ?> <br> <br></span>
          <h3 class="header">Detail To Do list</h3>
					<textarea style="border: none" rows="8" cols="83" class="item <?php echo $item['done'] ? ' done' : ''?>" readonly><?php echo parse($item['detail']); ?> </textarea>
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
			<form class="item-add" action="add.php" method="POST">

        <!-- <p id="projectform"></p> -->
        <input type="text" name="project" id="projectform" placeholder="Project" class="input" autocomplete="off" required autofocus="autofocus">
        <input type="text" name="parentchild" id="parenchild" hidden class="input" autocomplete="off" required autofocus="autofocus" value="0">
				<input type="text" name="name" placeholder="Tulis To Do List" class="input" autocomplete="off" required>
        <textarea rows="8" cols="50" name="detail" placeholder="Tulis Detail To Do List" class="input" autocomplete="off" required></textarea>
        <!-- <input type="text" name="detail" placeholder="Tulis Detail To Do List" class="input" autocomplete="off" required> -->
        <input type="text" name="kendala" placeholder="Kendala yang ada atau akan ada" class="input" autocomplete="off" required>
        <input type="number" min="0" max="100" step="1" name="progress" placeholder="Total Progress" class="input" autocomplete="off" required>
        <input type="date" class="input" name="due_date" required>
				<input type="submit" value="Add" class="submit">
        <a href="logout.php" class="btn btn-default btn-flat">Logout</a>
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
          document.getElementById('projectform').value = str;
          document.getElementById("projectform").readOnly = false;
          document.getElementById('parenchild').value = "0";
          console.log(document.getElementById('parenchild').value);
        }

    }
  </script>
  <!-- <script>

  $("#projectid").on('change',function(){
      var values = $(this).val();
       $("#projectform").html(values);

    });
  </script> -->
</html>
