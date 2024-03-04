<?php

require "$path/db-functions/users.php";

function checker($list) {
	foreach($list as $item) {
		if(str_replace(" ", "", $item) == "" or empty($item))
			return true;
	}
	return false;
}
$name = "";
$username = "";
$email = "";
if ($_SERVER['REQUEST_METHOD']=="POST") {
	
	$name = $_POST['name'];
	$username = $_POST['username'];
	$email = $_POST['email'];
	$password = $_POST['password1'];
	$password2 = $_POST['password2'];

	if (checker([$name, $username, $email, $password])){
		$error = "Hamma maydonni to'ldiring !";
	}else if(strlen($username) < 5){
		$error = "Username kamida 5 belgi bo'lsin";
	}else if(!username_is_valid($username, $db)){
		$error = "Username yaroqsiz";
	}else if($password != $password2){
		$error = "Parolni mosligini tekshiring";
	}else{
		$result = create_user($username, $email, $password, $name, $db);
		if($result[0]){
			header('Location: /auth/login.php');
			die();
		}else{
			$error = $result[1];
		}
	}
}
?>