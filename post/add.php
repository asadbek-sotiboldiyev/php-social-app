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
    $file_name = $_FILES['image']['name'];
    $tmp_name = $_FILES['image']['tmp_name'];
    $folder = "/media/post/".date('d-m-Y-H-i').$file_name;
    if(move_uploaded_file($tmp_name, "..".$folder)){
        echo "<script>alert('Rasm yuklandi')</script>";
    }else{
        echo "<script>alert('Error')</script>";
    }

    create_post(
        $author_id = $profile['id'], 
        $text = $text,
        $photo = $folder, 
        $db = $db
    );
	header("Location: /profile?username=$username");
	die();
}

require "$path/header.php";
?>

<!-- Content -->

<div class="container">
    <form method="POST" enctype="multipart/form-data">
        <h2>Post Add +</h2>
        <p>Text</p>
        <textarea name="text" rows="5"></textarea>
        <input require type="file" name="image" id="image">
        <br>
        <button type="submit">Share</button>
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