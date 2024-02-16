<?php

require "$path/db-functions/users.php";

function checker($list) {
	foreach($list as $item) {
		if(str_replace(" ", "", $item) == "" or empty($item))
			return true;
	}
	return false;
}

if ($_SERVER['REQUEST_METHOD']=="POST") {
	
	$name = $_POST['name'];
	$username = $_POST['username'];
	$email = $_POST['email'];
	$password = $_POST['password'];

	if (checker([$name, $username, $email, $password])){
		$error = "Hamma maydonni to'ldiring !";
	}
	else{
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