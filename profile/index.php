<?php

$path = "../includes";

require "$path/database.php";

require "$path/db-functions/users.php";
require "$path/db-functions/profiles.php";
require "$path/db-functions/posts.php";
require "$path/db-functions/likes.php";
require "$path/db-functions/follows.php";
session_start();

$username = $_GET['username'];
$user = get_user_by_username($username, $db);

if(isset($_SESSION['profile']))
	$PROFILE = $_SESSION['profile'];

if(empty($user)){
	echo "<center><h1>User not found</h1><br><a href='/'>Back</a></center>";
}else{
	$profile = get_profile_by_username($username, $db);
	$profile_id = $profile['id'];
	$posts = get_posts_by_author_id($profile_id, $db);
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		follow($_SESSION['profile']['id'], $profile_id, $db);
		header("Location: /profile?username=".$username);
		die();
	}
	require "$path/header.php";
?>

<!-- Content -->
<link rel="stylesheet" href="../static/profile.css">
<link rel="stylesheet" href="../static/posts.css">
<div class="container">
	<div class='profile-info'>
		<div>
			<img class="profile-img" src="<?= $profile['photo']?>">
		</div>
		<div class="profile-right">
			<section>
				<h2><?= $profile['username'] ?></h2>

				<?php if(isset($PROFILE) and $PROFILE['username'] != $username):?>
					<form method="POST">
						<button type='submit' name="follow" value="follow" class="follow-btn">
							<?php echo (is_followed($_SESSION['profile']['id'], $profile_id, $db) ? "Unfollow -" : "Follow")?>
						</button>
					</form>
				<?php endif ?>

			</section>
			
			<table >
				<th><?= $profile['posts'] ?> posts</th>
				<th><?= $profile['followers'] ?> followers</th>
				<th><?= $profile['following'] ?> following</th>
			</table>
			<p><?= $profile['name'] ?></p>
		</div>
		<div class="cls"></div>
	</div>

	<hr>

	<?php if (isset($PROFILE) and $PROFILE['username']==$username): ?>
		<a class="button" href="/post/add.php">POST ADD +</a>
		<a class="button" href="edit.php">SETTINGS</a>
	<?php endif ?>

	<hr>
	<div id="posts">
		<?php foreach ($posts as $post): ?>
			<?php
				$profile = get_profile_by_id($post['author_id'], $db);
				$post_author_username = $profile['username'];
			?>
			<div class="home-post-card">
				<img class="post-img" src="<?= $post['photo']?>" class="card-img">
				<div class="card-btn-group">
					<button onclick=like(this) class="card-btn" value=<?php echo $post['id']?>>
						<img src="../static/images/like.png" alt="">
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
		<?php endforeach ?>
	</div>
</div>
<!-- End Content -->
<script src='../static/script.js'></script>
<?php require "$path/footer.php"; } ?>