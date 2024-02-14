<?php
$path = "../includes";

require "$path/database.php";
require "$path/db-functions/posts.php";

session_start();

if(!$_SESSION["authenticated"]){
    header("Location: /auth/login.php");
    die();
}

$profile = $_SESSION['profile'];
$username = $profile['username'];

if($_SERVER['REQUEST_METHOD'] == 'POST'){
	$text = $_POST['text'];
    create_post($author_id = $profile['id'], $text = $text, $photo = "0", $db = $db);
	header("Location: /profile?username=$username");
	die();
}

require "$path/header.php";
?>

<!-- Content -->

<div class="container">
    <form method="POST">
        <h2>Post Add +</h2>
        <form method="POST">
            <p>Text</p>
            <textarea name="text" rows="5"></textarea>
            <button type="submit">Share</button>
        </form>
    </form>
</div>

<!-- End-Content -->
<style>
    textarea{
        width: 100%;
        padding: 5px;
    }
</style>
<?php require "$path/footer.php"; ?>