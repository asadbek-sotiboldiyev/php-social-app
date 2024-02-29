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
    require "$path/db-functions/posts.php";
    require "$path/db-functions/likes.php";

?>

<link rel="stylesheet" href="../static/style.css">
<div class="container">
<div class="admin-card blue">
        <p class='title'>Foydalanuchilar</p>
        <p class='result'><?= get_users_count($db) ?></p>
    </div>
    <div class="admin-card green">
        <p class='title'>Jami postlar</p>
        <p class='result'><?= get_posts_count($db) ?></p>
    </div>
    <div class="admin-card green">
        <p class='title'>Jami likelar</p>
        <p class='result'><?= get_likes_count($db) ?></p>
    </div>
</div>

<?php }?>