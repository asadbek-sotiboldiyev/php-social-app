<?php

$title = "Sign-Up";
$path = "../includes";
require "$path/header.php";
require "$path/database.php";
require "signup-script.php";
?>
<!-- Content -->
<div class="container">
	<form method="post">
		
		<?php if (isset($error)): ?>
			<p class="block">
				<?= $error ?>
			</p>
		<?php endif ?>

		<h1>Sign-Up</h1>
		<div>
			<p>Name</p>
			<input  type="text" name="name">
		</div>
		<div>
			<p>Username</p>
			<input  type="text" name="username">
		</div>
		<div>
			<p>Email</p>
			<input  type="text" name="email">
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