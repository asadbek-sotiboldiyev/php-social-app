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
        // to be continued...
    }


require "$path/header.php";
?>
<!-- Content -->

<div class="container">
    <form method="POST" enctype="multipart/form-data">
        <h2>Edit: <?= $cuurent_username ?></h2>
        <div class="block">
            <p>username</p>
            <input type="text" name='username'>
        </div>

        <div class="block">
            <p>BIO</p>
            <textarea name="bio" rows="5"></textarea>
        </div>

        <div class="block">
            <input require type="file" name="image" id="image">
        </div>
        <br>
        <button type="submit">Save</button>
    </form>
</div>

<!-- End Content -->
<style>
    input, textarea, button{
        width: 100%;
    }
</style>
<?php require "$path/footer.php"; } ?>
