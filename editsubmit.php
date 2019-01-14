<?php

	// adding note

require_once 'app/init.php';

if(isset($_POST['name']) && isset($_POST['detail']) && isset($_POST['due_date']) && isset($_POST['kendala']) && isset($_POST['progress'])) {
	$name = trim($_POST['name']);
	$name = escape($name);
	$due_date = $_POST['due_date'];
	$kendala = $_POST['kendala'];
	$progress = $_POST['progress'];
  $itemedit = $_POST['iditem'];
  $detail = $_POST['detail'];

  if(!empty($name) && !empty($due_date) && !empty($kendala) && !empty($progress)) {
    $editQuery = $db->prepare("
      UPDATE `items` SET `name`=:name,`detail`=:detail,`kendala`=:kendala,`due_date`= :due_date,`progress`=:progress WHERE id=:id
    ");

    $editQuery->execute([
      'name' => $name,
      'detail' => $detail,
      'due_date' => $due_date,
      'kendala' => $kendala,
      'progress' => $progress,
      'id' => $itemedit,
    ]);
  }

}

header('Location: todo.php');

?>
