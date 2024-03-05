<?php
$title = 'Edit profile';
$path = "../includes";

require "$path/database.php";
require "$path/db-functions/profiles.php";

session_start();

require "$path/login-required.php";

$PROFILE = $_SESSION['profile'];
$cuurent_username = $PROFILE['username'];
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $username = $_POST['username'];
    $name = $_POST['name'];
    if(check_username_free($username, $db) or $username == $cuurent_username){
        $file_name = $_FILES['image']['name'];
        if(empty($file_name)){
            update_profile(
                $cuurent_username, 
                $username, 
                $name,
                $PROFILE['photo'],
                $db
            );
            $new_profile = get_profile_by_username($username, $db);
            $_SESSION['profile'] = $new_profile;

            header("Location: /profile?username=".$username);
            die();
        }else{
            $tmp_name = $_FILES['image']['tmp_name'];
            $folder = "/media/profile-img/".date('d-m-Y-H-i').$file_name;
            if(move_uploaded_file($tmp_name, "..".$folder)){
                $old_photo = $PROFILE['photo'];
                if($old_photo != "/media/profile-img/default.jpg"){
                    if(!unlink("..".$old_photo)){
                        echo "<script>alert('Error delete file')</script>";
                    }
                }
                update_profile(
                    $cuurent_username, 
                    $username,
                    $name,
                    $folder,
                    $db
                );

                $new_profile = get_profile_by_username($username, $db);
                $_SESSION['profile'] = $new_profile;

                header("Location: /profile?username=".$username);
                die();
            }else{
                echo "<script>alert('Error')</script>";
            }
        }
    }else{
        $error = 'Username band';
    }
}

require "$path/header.php";
?>
<!-- Content -->
<link rel="stylesheet" href="../static/post-add.css">
<div class="container">

    <form class="form" method='POST' enctype="multipart/form-data">
        <h1 id="title">Edit: <?= $cuurent_username ?></h1>
        <div class="form-control">
            <label class='input-lbl' for="username">Username</label>
            <input required type="text" name='username' value="<?= $PROFILE['username'] ?>" placeholder="Username">
            <?php if(isset($error)):?>
                <p class='error'><?= $error ?></p>
            <?php endif ?>
        </div>
        <div class="form-control">
            <label class='input-lbl' for="name">Name</label>
            <input required type="text" name='name' value="<?= $PROFILE['name'] ?>" placeholder="Name">
        </div>
        <div class="form-control">
            <label for="image-upl" class="label-img" id="label-img" require>Upload profile image</label>
            <input  type="file" name="image" id="image-upl" onchange="loadFile_img(event)" accept=".jpg, .jpeg, .png">
            <img class="output" id="output-img" width="250">
        </div>
        <button type='submit' class="submit-btn">Save</button>
        <a href="/auth/logout.php" class='logout'>Logout</a>
    </form>

</div>

<!-- End Content -->
<script src="../static/script.js"></script>
<?php require "$path/footer.php"; ?>
