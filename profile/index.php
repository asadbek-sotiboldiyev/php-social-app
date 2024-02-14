<?php

$path = "../includes";

require "$path/database.php";

require "$path/db-functions/users.php";
require "$path/db-functions/profiles.php";
require "$path/db-functions/posts.php";
session_start();

$username = $_GET['username'];
$user = get_user_by_username($username, $db);

if(empty($user)){
	echo "<center><h1>User not found</h1><br><a href='/'>Back</a></center>";
}else{

	$profile = get_profile_by_username($username, $db);
	$profile_id = $profile['id'];
	$posts = get_post_by_author_id($profile_id, $db);

	require "$path/header.php";
?>

<!-- Content -->
<link rel="stylesheet" href="../static/profile.css">
<link rel="stylesheet" href="../static/post.css">
<div class="container">
	<div class='profile-info'>
		<img class="profile-img" src="../media/profile-img/default.jpg">
		<div class="profile-right">
			<h2><?= $profile['username'] ?></h2>
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

	<?php if ($_SESSION['profile']['username']==$username): ?>
		<a class="button" href="/post/add.php">POST ADD +</a>
		<a class="button" href="#">SETTINGS</a>
	<?php endif ?>

	<hr>

	<?php foreach ($posts as $post): ?>
		<div class="post-card">
			<p><?php echo $post['text']?></p>
			<button class="like-btn"><img src="../static/images/like.png"></button> <?= $post['likes'] ?>
			<hr>
			<p><?= $post['date']?></p>
		</div>
	<?php endforeach ?>
</div>
<!-- End Content -->
<?php require "$path/footer.php"; } ?>