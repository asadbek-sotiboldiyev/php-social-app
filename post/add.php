<?php
$path = "../includes";

require "$path/database.php";
require "$path/db-functions/posts.php";

session_start();
require "$path/login-required.php";

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
<link rel="stylesheet" href="../static/post-add.css">
<div class="container">
    
    <form class="form" method='POST' enctype="multipart/form-data">
        <h1 id="title">Post add</h1>
        <div class="form-control">
            <textarea rows="4" name='text' placeholder="Text..."></textarea>
        </div>
        <div class="form-control">
            <label for="image-upl" class="label-img" id="label-img">Upload image</label>
            <input type="file" name="image" id="image-upl" onchange="loadFile_img(event)">
            <img class="output" id="output-img" width="250">
        </div>
        <button type='submit' class="submit-btn">Post</button>
    </form>
</div>

<!-- End-Content -->
<script src='../static/script.js'></script>
<?php require "$path/footer.php"; ?>