<?php
$title = "Home";
$path = "includes";

require "$path/header.php";
require "$path/database.php";

require "$path/db-functions/users.php";

$users = get_users($db);
?>
<!-- Content -->
<div class="container">
	<h1>Users</h1>
	<div>
		<?php foreach ($users as $user): ?>
			<p class="block">
				<a href="profile/?username=<?=$user['username']?>">
					<?=$user['username']?>
				</a>
			</p>
		<?php endforeach ?>
	</div>
</div>
<!-- End-Content -->


<?php require "$path/footer.php"; ?>