<?php
session_start();
$title = "Login";
$path = "../includes";


if(isset($_SESSION['authenticated'])){
	require "$path/header.php";
	require 'message.html';
}else{

require "$path/database.php";
require "$path/db-functions/users.php";
require "$path/db-functions/profiles.php";

if($_SERVER['REQUEST_METHOD'] == "POST"){
	$username = $_POST['username'];
	$password = $_POST['password'];
	$user = check_user($username, $password, $db);
	if(!$user)
		$error = "User not found";
	else{
		$error = "succes!";
		$profile = get_profile_by_username($username, $db);
		$user = get_user_by_username($username, $db);
		session_start();
		logged_in($username, $db);
		$_SESSION['profile'] = $profile;
		$_SESSION['authenticated'] = 1;
		if($user['admin'] == '1')
			$_SESSION['admin'] = true;
		header('Location: /');
		die();
}
}

?>
<link rel="stylesheet" href="../static/style.css">
<link rel="stylesheet" href="../static/form.css">
<!-- Content -->
<div class="container">
	<center>
		<form class="form" method='post'>
			<?php if (isset($error)): ?>
				<p class="error">
					<?= $error ?>
				</p>
			<?php endif ?>
			
			<h1 id="title">Login</h1>
			<div class="form-control">
				<label>Username</label>
				<input type="text" placeholder="Username" name='username'>
			</div>
			<div class="form-control">
				<label>Password</label>
				<input type="password" placeholder="Password" name='password'>
			</div>
			<button class="submit-btn">Login</button>
			<div class="other-way">
				<p>Don't have an account?</p>
				<a href="signup.php">Register</a>
			</div>
		</form>
	</center>
</div>
<!-- End-Content -->

<?php }?>