<?php
// User table
function get_users($db){
	$users = $db->query("SELECT * FROM users");
	$users = $users->fetchAll(PDO::FETCH_ASSOC);
	return $users;
}
function get_user_by_id($id, $db){
	$user = $db->query("SELECT * FROM users WHERE id = '$id'")->fetch(PDO::FETCH_ASSOC);
	return $user;
}
function get_user_by_username($username, $db){
	$username = strtolower($username);
	$user = $db->query("SELECT * FROM users WHERE username = '$username';")->fetch(PDO::FETCH_ASSOC);
	return $user;
}
function check_user($username, $password, $db){
	$username = strtolower($username);
	$query = $db->prepare("SELECT * FROM users WHERE username = :username and password = :password");
	$query->execute([
		"username" => $username,
		"password" => sha1($password)
	]);
	$user = $query->fetch((PDO::FETCH_ASSOC));
	if($user == false)
		return false;
	else
		return true;
}
function create_user($username, $email, $password, $name, $db){
	$username = strtolower($username);
	try{
		$query = $db->prepare("INSERT INTO users (`username`, `email`, `password`, `joined_date`) VALUES (:username, :email, :password, :joined_date)");
		$query->execute([
			"username" => $username,
			"email" => $email,
			"password" => sha1($password),
			"joined_date" => date("d-m-Y")
		]);

		$query = $db->prepare("INSERT INTO profiles (`name`, `username`) VALUES (:name, :username)");
		$query->execute([
			"name" => $name,
			"username" => $username
		]);
		return [true];
	}
	catch(Exception $e){
		if ($e->errorInfo[2] == "UNIQUE constraint failed: users.username"){
			$error = "Username band";
		}
		else if ($e->errorInfo[2] == "UNIQUE constraint failed: users.email"){
			$error = "Email band";
		}
		else{
			var_dump($e);
		}
		return [false, $error];
	}
}
?>