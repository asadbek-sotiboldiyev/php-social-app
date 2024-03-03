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

    require "$path/db-functions/profiles.php";
    $search = '';
    $last_logined_users = get_profiles_last_login($db);
    if(isset($_GET['q'])){
        $search = $_GET['q'];
        $last_logined_users = get_profiles_contains_username($search, $db);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/static/style.css">
    <link rel="stylesheet" href="/static/admin-users.css">
    <link rel="stylesheet" href="/static/admin.css">
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
        <!-- search -->
        <form class="search" method='GET'>
            <input type="text" name="q" placeholder="Find user" value="<?= $search ?>">
            <button>Find</button>
        </form>
        <!-- End search -->

        <!-- Users -->
        <div class="users-list">
            <?php foreach($last_logined_users as $user):?>
                <div class="card-user">
                    <img src="<?= $user['photo']?>">
                    <a href="/admin/user.php?username=<?= $user['username'] ?>">
                        <?= $user['username']?>
                    </a>
                </div>
            <?php endforeach ?>
        </div>
    </div>
    <!-- End-Content -->
</body>
</html>

<?php }?>