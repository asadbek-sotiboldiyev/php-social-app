<?php

$title = "Sign-Up";
$path = "../includes";

if(isset($_SESSION['authenticated'])){
	require 'message.html';
}else{
require "$path/database.php";
require "signup-script.php";
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
	
			<h1 id="title">Sign-Up</h1>
			<div class="form-control">
				<label>Name</label>
				<input required type="text" placeholder="Name" name='name' value="<?= $name ?>">
			</div>
			<div class="form-control">
				<label>Username</label>
				<input required type="text" placeholder="Username" name='username' value="<?= $username ?>">
			</div>
			<div class="form-control">
				<label>Email</label>
				<input required type="text" placeholder="Email" name='email' value="<?= $email ?>">
			</div>
			<div class="form-control">
				<label>Password</label>
				<input required type="password" placeholder="Password" name='password1'>
			</div>
			<div class="form-control">
				<label>Repeat password</label>
				<input required type="password" placeholder="Repeat password" name='password2'>
			</div>
			<button class="submit-btn">Sign-Up</button>
			<div class="other-way">
				<p>Already have an account?</p>
				<a href="login.php">Login</a>
			</div>

		</form>
	</center>
</div>
<!-- End-Content -->
<?php }?>