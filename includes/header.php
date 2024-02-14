<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="<?= $path ?>/../static/style.css">
	<title><?= $title ?></title>
</head>
<body>
	<header>
		<div class="container">
			<h1><a href="/">MyBlog</a></h1>
			<nav>
				<?php if($_SESSION['authenticated']): ?>
					Profile: <a href="/profile/?username=<?= $_SESSION['profile']['username'] ?>">
						<?php echo $_SESSION['profile']['name']; ?>
					</a>
					<br>
					<a href="/auth/logout.php">Logout</a>
				<?php else: ?>
					<a href="/auth/signup.php">Sign-Up</a>
					<a href="/auth/login.php">Login</a>
				<?php endif ?>
			</nav>
		</div>
	</header>
	<hr>