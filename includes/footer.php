<footer>
    <a href="/" class="footer-link">
        <img src="<?= $path?>/../static/images/home.png" class="invert">
    </a>
    <a href="/post/add.php" class="footer-link">
        <img src="<?= $path?>/../static/images/plus.png" class="invert">
    </a>
    <a href="/profile/?username=<?= $_SESSION['profile']['username'] ?>" class="footer-link">
        <img src="<?= $_SESSION['profile']['photo']?>">
    </a>
</footer>
</body>
</html>