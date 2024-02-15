<?php
$path = "../includes";
require "$path/database.php";
$command = $_GET['command'];
if($command == 'like'){
	$post_id = $_GET['post_id'];
	$username = $_GET['username'];
	$response = [
		"message" => "liked",
		"post" => $post_id,
		"user" => $username
	];
	echo json_encode($response);
}
else echo json_encode(['message' => 'error']);
?>