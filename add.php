<?php

	// adding note

require_once 'app/init.php';

if(isset($_POST['name']) && isset($_POST['detail']) && isset($_POST['due_date']) && isset($_POST['kendala'])) {
	$name = trim($_POST['name']);
	$name = escape($name);
	$due_date = $_POST['due_date'];
	$kendala = $_POST['kendala'];
	$progress = $_POST['progress'];
	$detail = $_POST['detail'];
	$project = $_POST['project'];
	$parentchild = $_POST['parentchild'];


	if(!empty($name) && !empty($detail) && !empty($due_date) && !empty($kendala)) {
		$addedQuery = $db->prepare("
			INSERT INTO items (project, parentchild, name, detail, user, kendala, due_date, progress, done, delete_status, user_name, created)
			VALUES (:project, :parentchild, :name, :detail, :user, :kendala, :due_date, :progress, 0, 0, :user_name, NOW())
		");

		$addedQuery->execute([
			'project' => $project,
			'parentchild' => $parentchild,
			'name' => $name,
			'detail' => $detail,
			'due_date' => $due_date,
			'kendala' => $kendala,
			'progress' => $progress,
			'user' => $_SESSION['ID'],
			'user_name' => $_SESSION['username']
		]);
	}

}

header('Location: todo.php');

?>
