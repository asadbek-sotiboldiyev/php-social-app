<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="<?= $path ?>/../static/style.css">
	<link rel="stylesheet" type="text/css" href="<?= $path ?>/../static/footer.css">
	<title><?= $title ?></title>
</head>
<body>
	<header>
		<div class="container">
			<div id="header-flex">
				<h2 id="afisha">
					<a href="/">PHPgramm</a>
				</h2>
				<?php if(isset($_SESSION['admin'])):?>
					<nav class='header-nav'>
						<a href="/admin" class="nav-link">Admin</a>
					</nav>
				<?php endif?>
			</div>
		</div>
	</header>
