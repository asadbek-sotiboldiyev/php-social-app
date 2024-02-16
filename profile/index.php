<?php

$path = "../includes";

require "$path/database.php";

require "$path/db-functions/users.php";
require "$path/db-functions/profiles.php";
require "$path/db-functions/posts.php";
require "$path/db-functions/likes.php";
session_start();

$username = $_GET['username'];
$user = get_user_by_username($username, $db);

if(empty($user)){
	echo "<center><h1>User not found</h1><br><a href='/'>Back</a></center>";
}else{
 
	$profile = get_profile_by_username($username, $db);
	$profile_id = $profile['id'];
	$posts = get_posts_by_author_id($profile_id, $db);
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
	<div id="posts">
		<?php foreach ($posts as $post): ?>
			<div class="post-card">
				<img src="<?= $post['photo']?>" style='width:100%'>
				<p><?php echo $post['text']?></p>
				<button onclick=like(this) class="like-btn" value=<?php echo $post['id']?> ><img src="../static/images/like.png"></button> <?= $post['likes'] ?>
				<hr>
				<p><?= $post['date']?></p>
			</div>
		<?php endforeach ?>
	</div>
</div>
<!-- End Content -->
<script>
function like(e){
	if(<?php echo ($_SESSION['authenticated'] ? 1 : 0) ?>){
		const username = "<?php echo $_SESSION['profile']['username'] ?>";
		const profile_id = "<?php echo $_SESSION['profile']['id'] ?>";
		let post_id = e.value;
		console.log(post_id);
		console.log(username);


	}else{
		alert("Register required");
	}
}
</script>
<?php require "$path/footer.php"; } ?>