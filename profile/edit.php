<?php

$path = "../includes";

require "$path/database.php";
require "$path/db-functions/profiles.php";

session_start();

if(!$_SESSION['authenticated']){
    echo "<center><h1>403</h1><br><a href='/'>Back</a></center>";
}else{
    $cuurent_username = $_SESSION['profile']['username'];
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $username = $_POST['username'];
        if(check_username_free($username, $db) or $username == $cuurent_username){
            $bio = $_POST['bio'];
            $file_name = $_FILES['image']['name'];
            $tmp_name = $_FILES['image']['tmp_name'];
            $folder = "/media/profile-img/".date('d-m-Y-H-i').$file_name;
            if(move_uploaded_file($tmp_name, "..".$folder)){
                $old_photo = $_SESSION['profile']['photo'];
                if($old_photo != "/media/profile-img/default.jpg"){
                    if(!unlink("..".$old_photo)){
                        echo "<script>alert('Error delete file')</script>";
                    }
                }
                update_profile(
                    $cuurent_username, 
                    $username, 
                    $folder,
                    $bio,
                    $_SESSION['profile']['followers'],
                    $_SESSION['profile']['psots'],
                    $_SESSION['profile']['following'],
                    $db
                );

                $new_profile = get_profile_by_username($username, $db);
                $_SESSION['profile'] = $new_profile;

                header("Location: /profile?username=".$username);
                die();
            }else{
                echo "<script>alert('Error')</script>";
            }
        }else{
            $error = 'Username band';
        }
    }

require "$path/header.php";
?>
<!-- Content -->

<div class="container">
    <form method="POST" enctype="multipart/form-data">
        <h2>Edit: <?= $cuurent_username ?></h2>
        <div class="block">
            <p>username</p>
            <input type="text" name='username' value=<?= $_SESSION['profile']['username'] ?>>
            <?php if(isset($error)):?>
                <p><?= $error ?></p>
            <?php endif ?>
        </div>

        <div class="block">
            <p>BIO</p>
            <textarea name="bio" rows="5"><?= $_SESSION['profile']['bio'] ?></textarea>
        </div>

        <div class="block">
            <input require type="file" name="image" id="image">
        </div>
        <br>
        <button type="submit">Save</button>
    </form>
    <a href="/auth/logout.php">Logout</a>
</div>

<!-- End Content -->
<style>
    input, textarea, button{
        width: 100%;
    }
</style>
<?php require "$path/footer.php"; } ?>
