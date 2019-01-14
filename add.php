<?php

	// adding note

require_once 'app/init.php';

if(isset($_POST['name']) && isset($_POST['detail']) && isset($_POST['due_date']) && isset($_POST['kendala']) && isset($_POST['progress'])) {
	$name = trim($_POST['name']);
	$name = escape($name);
	$due_date = $_POST['due_date'];
	$kendala = $_POST['kendala'];
	$progress = $_POST['progress'];
	$detail = $_POST['detail'];


	if(!empty($name) && !empty($detail) && !empty($due_date) && !empty($kendala) && !empty($progress)) {
		$addedQuery = $db->prepare("
			INSERT INTO items (name, detail, user, kendala, due_date, progress, done, delete_status, user_name, created)
			VALUES (:name, :detail, :user, :kendala, :due_date, :progress, 0, 0, :user_name, NOW())
		");

		$addedQuery->execute([
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
