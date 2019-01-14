<?php

	// adding note

require_once 'app/init.php';

if(isset($_POST['name']) && isset($_POST['due_date']) && isset($_POST['kendala'])) {
	$name = trim($_POST['name']);
	$name = escape($name);
	$due_date = $_POST['due_date'];
	$kendala = $_POST['kendala'];


	if(!empty($name)) {
		$addedQuery = $db->prepare("
			INSERT INTO items (name, user, kendala, due_date, done, delete_status, user_name, created)
			VALUES (:name, :user, :kendala, :due_date, 0, 0, :user_name, NOW())
		");

		$addedQuery->execute([
			'name' => $name,
			'due_date' => $due_date,
			'kendala' => $kendala,
			'user' => $_SESSION['ID'],
			'user_name' => $_SESSION['username']
		]);
	}

}

header('Location: todo.php');

?>
