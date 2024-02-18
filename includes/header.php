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
			<div id="header-flex">
				<h2 id="afisha">
					<a href="/">PHPgramm</a>
				</h2>
				<nav id="header-nav">
					<?php if($_SESSION['authenticated']): ?>
						<a href="/profile/?username=<?= $_SESSION['profile']['username'] ?>" class="nav-link">
							Profile
						</a>
					<?php else: ?>
						<a href="/auth/signup.php" class="nav-link">Register</a>
						<a href="/auth/login.php" class="nav-link">Login</a>
					<?php endif ?>
				</nav>
			</div>
		</div>
	</header>
