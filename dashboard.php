<?php
session_start();
if (!isset($_SESSION["user"])) {
    header("Location: inlog.php");
    exit();
}
?>

<h2>Welkom, <?php echo $_SESSION["user"]; ?>!</h2>
<a href="logout.php">Uitloggen</a>
