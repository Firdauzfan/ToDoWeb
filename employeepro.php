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
<?php
if(isset($_POST['btn-submit'])){
  $_SESSION['valuejudulproject'] = $_POST['valuejudulproject'];
}
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
        <?php foreach($usersself as $useritself): ?>
  			<h1 class="header">Input To Do List => <a href="graphemployee.php?id=<?php echo $useritself['id_pegawai']; ?>"><?php echo $useritself['username']; ?></a> </h1>
        <?php endforeach; ?>

        <form action="employeepro.php?id=<?php echo $submit_id; ?>" method="post">
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

                                $judul="SELECT project FROM items WHERE user=$submit_id AND delete_status='0' AND parentchild='0'";
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
          <?php
          $sqlitems = "SELECT id, project, name, detail, kendala, due_date, done, progress FROM items WHERE user = :user AND delete_status='0' AND parentchild='0' ";

           if (strlen($_SESSION['valuejudulproject'])>=1) {
                if ($_SESSION['valuejudulproject']=='All') {
                  $sqlitems .= " ";
                }else {
                  if ($_SESSION['valuejudulproject']) {
                    $judul=$_SESSION['valuejudulproject'];
                    $sqlitems .= "AND project='$judul' ";
                  }

                }
            }

        $itemsQuery = $db->prepare($sqlitems);

        $itemsQuery->execute([
          'user' => $submit_id
        ]);

        $items = $itemsQuery->rowCount() ? $itemsQuery : [];

         ?>
  			<?php if(!empty($items)): ?>
  			<ul class="items">
  				<?php foreach($items as $item): ?>

  				<li>
            <h3 class="header">Project <?php echo $item['user_name']; ?></h3>
  					<span class="item<?php echo $item['done'] ? ' done' : ''?>"> <?php echo parse($item['project']); ?> <br> <br></span>
            <h3 class="header">Project Detail <?php echo $item['user_name']; ?></h3>
  					<span class="item<?php echo $item['done'] ? ' done' : ''?>"> <?php echo parse($item['name']); ?> <br> <br></span>
            <h3 class="header">Detail Project To Do</h3>
  					<textarea style="border: none" rows="8" cols="79" class="item <?php echo $item['done'] ? ' done' : ''?>" readonly><?php echo parse($item['detail']); ?> </textarea>
            <h3 class="header">Kendala Project yang Ada atau Akan Ada</h3>
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
