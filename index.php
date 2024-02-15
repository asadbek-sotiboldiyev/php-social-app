<?php
$title = "Home";
$path = "includes";

require "$path/header.php";
require "$path/database.php";

require "$path/db-functions/users.php";
require "$path/db-functions/posts.php";
require "$path/db-functions/profiles.php";

$users = get_users($db);

$users_list="";
foreach($users as $user){
	$users_list = $users_list . ", " . $user['id'];
}
$users_list = substr($users_list, 1);
$posts = get_posts_author_in_list($users_list,$db);
?>
<!-- Content -->
<div class="container">
	<h1>Posts</h1>
	<div>
		<?php foreach ($posts as $post): ?>
			<?php
				$profile = get_profile_by_id($post['author_id'], $db);
				$post_author_username = $profile['username'];
			?>
			<div class="block">
				<h4>
					<a href="/profile/?username=<?=$post_author_username?>">
						<?= $post_author_username ?>
					</a>
				</h4>
				<hr>
				<p><?= $post['text'] ?></p>
				<hr>
				<p style="text-align:right"><?= $post['date'] ?></p>
			</div>
			<br>
		<?php endforeach ?>
	</div>
</div>
<!-- End-Content -->


<?php require "$path/footer.php"; ?>