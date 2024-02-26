<?php
if(!isset($_SESSION["authenticated"])){
    header("Location: /auth/login.php");
    die();
}
?>