<?php

header('Access-Control-Allow-Origin: *');

$path = "../includes";
require "$path/database.php";
require "$path/db-functions/profiles.php";
require "$path/db-functions/likes.php";

if(1){
	$command = $_GET['command'];
	if($command == 'like'){
		$post_id = $_GET['post_id'];
		$user_id = $_GET['user_id'];

		$profile = get_profile_by_id($user_id, $db);

		like($post_id, $user_id, $db);

		$response = [
			"message" => "liked",
			"post" => $post_id,
			"user" => $profile['id']
		];
		echo json_encode($response);
	}
	else echo json_encode(['message' => 'error']);
}else{
	echo json_encode(['message' => 'invalid session']);
}
?>