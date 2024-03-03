<?php
session_start();
$title = "Admin panel";
$path = "../includes";

require "$path/login-required.php";

require "$path/database.php";
require "$path/db-functions/users.php";

$PROFILE = $_SESSION['profile'];

if(!user_is_admin($PROFILE['id'], $db)){
    require "$path/403.php";
}else{
    $username = $_GET['username'];

    require "$path/db-functions/profiles.php";

    $profile = get_profile_by_username($username, $db);
    $user = get_user_by_username($username, $db);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/static/style.css">
    <link rel="stylesheet" href="/static/admin.css">
    <link rel="stylesheet" href="/static/admin-user.css">
    <title>Admin panel</title>
</head>
<body>
    <header>
		<div class="container">
            <h2 id="afisha">
                <a>Admin panel</a>
            </h2>
            <nav>
                <a class="header-link" href="/admin">Home</a>
                <a class="header-link" href="/admin/users.php">Users</a>
            </nav>
		</div>
	</header>

    <!-- Content -->
    <div class="container">
        <img class="profile-img" src="<?= $profile['photo'] ?>">
        <a href="/profile?username=<?= $profile['username'] ?>" class="open-link" target='_blank'>Open</a>
        <div class="profile-info">
            <span>Name</span>
            <p><?= $profile['name'] ?></p>
        </div>
        <div class="profile-info">
            <span>Username</span>
            <p>@<?= $profile['username'] ?></p>
        </div>
        <div class="profile-info">
            <span>Email</span>
            <p><?= $user['email'] ?></p>
        </div>
        <div class="profile-info">
            <span>Last login</span>
            <p><?= $profile['last_login'] ?></p>
        </div>
        <div class="profile-info">
            <span>Joined date</span>
            <p><?= $user['joined_date'] ?></p>
        </div>

        <!-- Stat cards -->
        <div class="stat-cards">
            <div class="card blue"> 
                <p class="title">Posts</p>
                <p class="result">
                    <?= $profile['posts'] ?>
                </p>
            </div>
            <div class="card green">
                <p class="title">Followers</p>
                <p class="result">
                    <?= $profile['followers'] ?>
                </p>
            </div>
            <div class="card orange">
                <p class="title">Followings</p>
                <p class="result">
                    <?= $profile['following'] ?>
                </p>
            </div>
        </div>
        <!-- End Stat cards -->

        <!-- Btn group -->
        <form class="btn-form">
            <button class="btn red">Delete</button>
            <button class="btn red">Ban</button>
        </form>
        <!-- End Btn group -->
    </div>
    <!-- End-Content -->
</body>
</html>


<?php }?>