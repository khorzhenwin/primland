
<footer>
    <p>Copyright 2020 Primland</p>

    <?php 
    if (!isset($_SESSION['usertype'])) {
        echo "<div class='center'><a href='loginstaff.php'>Management</a></div>";
    }
    ?>
    
</footer>

<style>
footer {
    background-color: #382102;
    padding: 2em 0;
}

footer p {
    text-align: center;
    font-size: 1em;
    color: white;
}
</style>
</body>
</html>