<?php
$session_id = $_GET['session_id'];
session_id($session_id);

session_start();

$path = "../includes";
require "$path/database.php";

if(1){
	$command = $_GET['command'];
	if($command == 'like'){
		$post_id = $_GET['post_id'];
		$response = [
			"message" => "liked",
			"post" => $post_id,
			"user" => $_SESSION['profile']['username']
		];
		echo json_encode($response);
	}
	else echo json_encode(['message' => 'error']);
}else{
	echo json_encode(['message' => 'invalid session']);
}
?>