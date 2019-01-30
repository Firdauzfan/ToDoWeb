<?php

	// adding note

require_once 'app/init.php';

if(isset($_POST['name']) && isset($_POST['detail']) && isset($_POST['due_date']) && isset($_POST['kendala'])) {
	$name = trim($_POST['name']);
	$name = escape($name);
	$due_date = $_POST['due_date'];
	$kendala = $_POST['kendala'];
	$progress = $_POST['progress'];
  $itemedit = $_POST['iditem'];
  $detail = $_POST['detail'];
	$project = $_POST['project'];
	$parentchild = $_POST['parentchild'];

  if(!empty($name) && !empty($due_date) && !empty($kendala)) {
    $editQuery = $db->prepare("
      UPDATE `items` SET `project`=:project,`parentchild`=:parentchild,`name`=:name,`detail`=:detail,`kendala`=:kendala,`due_date`= :due_date,`progress`=:progress WHERE id=:id
    ");

    $editQuery->execute([
			'project' => $project,
      'parentchild' => $parentchild,
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
