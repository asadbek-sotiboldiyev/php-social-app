<?php
$path = "../includes";
require "$path/database.php";

$username = $_GET['username'];
$user = $db->query("SELECT name, username, email FROM users WHERE username = '$username'")->fetch();
if(empty($user))
	echo json_encode(['message' => 'user-not-found']);
else
	echo json_encode($user);
?>