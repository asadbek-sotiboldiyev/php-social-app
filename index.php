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
	<div id="posts-reels">
	<center>
		<?php foreach ($posts as $post): ?>
			<?php
				$profile = get_profile_by_id($post['author_id'], $db);
				$post_author_username = $profile['username'];
			?>
			<div class="post-card">
				<div class="card-header">
					<img src="<?= $profile['photo'] ?>" class="card-user-img">
					<a href="/profile/?username=<?=$post_author_username?>" class="card-user">
								<?= $post_author_username ?>
					</a>
				</div>
				<img src="<?= $post['photo']?>" class="card-img">
				<div class="card-btn-group">
					<button class="like-btn" value=<?php echo $post['id']?> ><img src="./static/images/like.png"></button> <?= $post['likes'] ?>
				</div>
				<p class="card-text"><?= $post['text'] ?></p>
				<br>
				<p class="card-date"><?= $post['date'] ?></p>
			</div>
		<?php endforeach ?>
	</center>
	</div>
</div>
<!-- End-Content -->


<?php require "$path/footer.php"; ?>