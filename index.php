<?php
$title = "Home";
$path = "includes";

require "$path/header.php";
require "$path/database.php";

require "$path/db-functions/users.php";
require "$path/db-functions/posts.php";
require "$path/db-functions/profiles.php";
require "$path/db-functions/follows.php";

$users_list = get_followings_as_string($_SESSION['profile']['id'], $db);
$posts = get_posts_author_in_list($users_list,$db);

$follows = get_followings($_SESSION['profile']['id'], $db);
?>

<!-- Content -->

<div class="container">
	<div id="content">
		<div id="followers-reel">
			<?php foreach ($follows as $follwing_profile): ?>
				<div class="following-user-card">
					<a href="/profile/?username=<?= $follwing_profile['username']?>">
						<?= $follwing_profile['username']?>
					</a>
				</div>
			<?php endforeach ?>
		</div>

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
</div>
<!-- End-Content -->


<?php require "$path/footer.php"; ?>