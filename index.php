<?php
session_start();
if(isset($_SESSION['username'])){
		if ($_SESSION['username']=='admin') {
			header('location:admin.php');
		}else {
			header('location:todo.php');
		}

}
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
// Start the session
?>
<!DOCTYPE html>
<html>
<head>
<?php
//DATABSE DETAILS//
// $host_name="localhost";
// $user_name="gspecrmc_user";
// $password="gspepws123";
// $database="gspecrmc_data";
date_default_timezone_set('Asia/Jakarta');
?>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Login</title>

<link href="bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<?php
include('app/connect.php');
if(isset($_POST['tSubmit'])){
$Id_Pegawai = $_POST['id_pegawai'];
$Pass = $_POST['Pass'];
	if (empty($_POST['id_pegawai']) || empty($_POST['Pass'])) {
 	echo "<script>";
    echo "alert('Id Pegawai dan Password Harus Diisi')";
   	echo "</script>";
 	}else{
	 //$dept_id =  $_POST['dept_id'];
	 $sql = mysqli_query($con, "SELECT * FROM users WHERE id_pegawai='$Id_Pegawai' AND password='$Pass'") or die(mysqli_error());
	 if(mysqli_num_rows($sql) == 0){
	  echo "<script>alert('ID Pegawai atau Password salah')</script>";

	 }else{
	 	$row = mysqli_fetch_assoc($sql);
	 	$_SESSION['ID']=$row['id_pegawai'];
		$_SESSION['username']=$row['username'];
		 if ($_SESSION['username']=='admin'){
	   echo '<script language="javascript">document.location="admin.php";</script>';
	 }else{
		 echo '<script language="javascript">document.location="todo.php";</script>';
	 }
	 }
}
}
?>
<body>
	<br>
	<div class="row">
		<div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
			<div class="login-panel panel panel-default">
				<img class="img-responsive" alt="GSPE" src="dist/img/logovio.png">
				<div class="panel-heading"><b>Login</b></div>
				<div class="panel-body">
					<form role="form" name="LoginF" action="index.php" method="POST">
						<fieldset>
							<div class="form-group">
								<input class="form-control" placeholder="ID Pegawai" name="id_pegawai" type="text" autofocus="">
							</div>
							<div class="form-group">
								<input class="form-control" id="Pass" placeholder="Password" name="Pass" type="password">
								<input type="checkbox" onclick="myFunction()"> Show Password
							</div>
							<!-- <span><a href="forgetpwd.php">Forgot Password</a></span> -->
							<!-- <br> -->
							<br>
							<input type="Submit" class="btn btn-primary" name="tSubmit" value=" Login ">
						</fieldset>
					</form>
				</div>
			</div>
		</div><!-- /.col-->
	</div><!-- /.row -->
	<script>
	function myFunction() {
	    var x = document.getElementById("Pass");
	    if (x.type === "password") {
	        x.type = "text";
	    } else {
	        x.type = "password";
	    }
	}
	</script>
	<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script>
		!function ($) {
			$(document).on("click","ul.nav li.parent > a > span.icon", function(){
				$(this).find('em:first').toggleClass("glyphicon-minus");
			});
			$(".sidebar span.icon").find('em:first').addClass("glyphicon-plus");
		}(window.jQuery);
		$(window).on('resize', function () {
		  if ($(window).width() > 768) $('#sidebar-collapse').collapse('show')
		})
		$(window).on('resize', function () {
		  if ($(window).width() <= 767) $('#sidebar-collapse').collapse('hide')
		})
	</script>
</body>

</html>
