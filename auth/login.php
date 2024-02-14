<?php

$title = "Login";
$path = "../includes";

require "$path/header.php";
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
		session_start();
		$_SESSION['profile'] = $profile;
		$_SESSION['authenticated'] = true;
		header('Location: /');
		die();
}
}

?>

<!-- Content -->
<div class="container">
	<form method="post">
		
		<?php if (isset($error)): ?>
			<p class="block">
				<?= $error ?>
			</p>
		<?php endif ?>

		<h1>Login</h1>
		<div>
			<p>Username</p>
			<input  type="text" name="username">
		</div>
		<div>
			<p>Password</p>
			<input  type="text" name="password">
		</div>
		<button>Submit</button>
	</form>
</div>
<!-- End-Content -->

<?php require "$path/footer.php"; ?>