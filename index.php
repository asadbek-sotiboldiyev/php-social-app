<?php
session_start();
$title = "Home";
$path = "includes";

require "$path/header.php";
require "$path/database.php";

if(empty($_SESSION)){
	header("Location: /auth/login.php");
	die();
}

require "$path/db-functions/users.php";
require "$path/db-functions/posts.php";
require "$path/db-functions/profiles.php";
require "$path/db-functions/follows.php";

$users_list = get_followings_as_string($_SESSION['profile']['id'], $db);
$posts = get_posts_author_in_list($users_list,$db);

$follows = get_followings($_SESSION['profile']['id'], $db);
?>
<link rel="stylesheet" href="./static/home.css">
<link rel="stylesheet" href="./static/posts.css">
<!-- Content -->

<div class="container">
	
<div class="following-scroll">
		<?php foreach ($follows as $follwing_profile): ?>
			<a href="/profile/?username=<?= $follwing_profile['username']?>">
				<?= $follwing_profile['username']?>
			</a>
		<?php endforeach ?>
	</div>

	<center>
		<?php foreach ($posts as $post): ?>
			<?php
				$profile = get_profile_by_id($post['author_id'], $db);
				$post_author_username = $profile['username'];
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
					<button onclick=like(this) class="card-btn dis-liked" value=<?php echo $post['id']?>>
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