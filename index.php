<?php
session_start();
$title = "Home";
$path = "includes";

require "$path/header.php";
require "$path/database.php";

require "$path/login-required.php";

require "$path/db-functions/users.php";
require "$path/db-functions/posts.php";
require "$path/db-functions/profiles.php";
require "$path/db-functions/follows.php";
require "$path/db-functions/likes.php";

$PROFILE = $_SESSION['profile'];

$users_list = get_followings_as_string($PROFILE['id'], $db);
$posts = get_posts_author_in_list($users_list,$db);

$top_users = get_top_profiles(
	get_followings_as_string($PROFILE['id'], $db),
	$PROFILE['id'],
	$db
);

$follows = get_followings($PROFILE['id'], $db);
?>

<link rel="stylesheet" href="./static/home.css">
<link rel="stylesheet" href="./static/posts.css">
<!-- Content -->

<div class="container">
	<!--Following  -->
	<?php if($PROFILE['followings'] > 0):?>
		<div class="following-scroll">
			<?php foreach ($follows as $follwing_profile): ?>
				<a class="following-user" href="/profile/?username=<?= $follwing_profile['username']?>">
					<?= $follwing_profile['username']?>
				</a>
			<?php endforeach ?>
		</div>
	<?php endif?>
	<!--End-Following  -->

	<!-- Recommendation -->
	<?php if($PROFILE['follower'] <= 10):?>
		<div class="following-scroll">
			<?php foreach ($top_users as $user): ?>
				<div class="rec-card">
					<center>
						<img src="<?= $user['photo'] ?>">
						<a href="/profile?username=<?= $user['username'] ?>" class="rec-user"><?= $user['username'] ?></a>
						<br>
						<a class="rec-view" href="/profile?username=<?= $user['username'] ?>">View</a>
					</center>
				</div>
			<?php endforeach ?>
		</div>
	<?php endif?>
	<!-- End-Recommendation -->

	<center>
		<?php foreach ($posts as $post): ?>
			<?php
				$profile = get_profile_by_id($post['author_id'], $db);
				$post_author_username = $profile['username'];

				$is_liked = is_liked($post['id'], $PROFILE['id'], $db);
				if($is_liked)
					$is_liked = "liked";
				else
					$is_liked = 'dis-liked';
			?>
			<div class="home-post-card">
				<div class="card-header">
					<img src="<?= $profile['photo'] ?>" alt="">
					<a href="/profile/?username=<?=$post_author_username?>" class="card-user">
						<?= $post_author_username ?>
					</a>
				</div>

				<img class="post-img" src="<?= $post['photo']?>" class="card-img">
				<div class="card-btn-group">
					<button onclick="like(this, <?= $PROFILE['id'] ?>)" class="card-btn <?= $is_liked ?>" value=<?php echo $post['id']?>>
						<img src="./static/images/like.png" alt="">
					</button>
					<p class="like-count">
						<?= $post['likes'] ?>
					</p>
				</div>
				<hr>
				<p class="card-text"><?= $post['text'] ?></p>
				<hr>
				<p class="card-date"><?= $post['date'] ?></p>
			</div>
			<br>
		<?php endforeach ?>
	</center>
</div>
<!-- End-Content -->

<script src='static/script.js'></script>
<!-- <script>
	<?php require "static/script.js";?>
</script> -->
<?php require "$path/footer.php"; ?>