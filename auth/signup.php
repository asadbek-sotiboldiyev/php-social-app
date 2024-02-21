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
				<input type="text" placeholder="Name" name='name'>
			</div>
			<div class="form-control">
				<input type="text" placeholder="Username" name='username'>
			</div>
			<div class="form-control">
				<input type="text" placeholder="Email" name='email'>
			</div>
			<div class="form-control">
				<input type="password" placeholder="Password" name='password1'>
			</div>
			<div class="form-control">
				<input type="password" placeholder="Repeat password" name='password2'>
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

<?php require "$path/footer.php"; }?>