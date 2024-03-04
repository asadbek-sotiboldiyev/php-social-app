<?php

$path = "../includes";

require "$path/database.php";

require "$path/db-functions/users.php";
require "$path/db-functions/profiles.php";
require "$path/db-functions/posts.php";
require "$path/db-functions/likes.php";
require "$path/db-functions/follows.php";

session_start();
require "$path/login-required.php";

$username = $_GET['username'];
$user = get_user_by_username($username, $db);

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
	$title = $profile['username'];
	require "$path/header.php";
?>

<!-- Content -->
<link rel="stylesheet" href="../static/profile.css">
<link rel="stylesheet" href="../static/posts.css">
<div class="container">

	<div class='profile-info'>
		<div class="profile-flex">
			<img class="profile-img" src="<?= $profile['photo']?>">

			<div class="profile-right">
				<section>
					<h2 class="profile-username">
						<?= $profile['username'] ?>
					</h2>

					<?php if(isset($PROFILE) and $PROFILE['username'] != $username):?>
					<form method="POST">
						<button type='submit' name="follow" value="follow" class="button">
							<?php echo (is_followed($_SESSION['profile']['id'], $profile_id, $db) ? "Unfollow -" : "Follow")?>
						</button>
					</form>
					<?php endif ?>

				</section>
				<p class="profile-name">
					<?= $profile['name'] ?>
				</p>
			</div>
		</div>

		<table class="profile-table">
			<th>posts</th>
			<th>followers</th>
			<th>following</th>
			<tr>
				<td><?= $profile['posts'] ?></td>
				<td><?= $profile['followers'] ?></td>
				<td><?= $profile['following'] ?></td>
			</tr>
		</table>
	</div>

	<!-- For user -->
	<?php if (isset($PROFILE) and $PROFILE['username']==$username): ?>
		<hr>
		<a class="button" href="/post/add.php">POST ADD +</a>
		<a class="button" href="/profile/edit.php">SETTINGS</a>
	<?php endif ?>

	<!-- Posts -->
	<div id="posts">
		<?php if($profile['ban'] == '0'): ?>
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
					<img class="post-img" src="<?= $post['photo']?>" class="card-img">
					<div class="card-btn-group">
						<button onclick="like(this, <?= $PROFILE['id'] ?>)" class="card-btn <?= $is_liked ?>" value=<?php echo $post['id']?>>
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
		<?php else:?>
			<h1 class='banned'>This account banned!</h1>
		<?php endif?>
	</div>
</div>
<!-- End Content -->
<script src='../static/script.js'></script>
<?php require "$path/footer.php"; } ?>