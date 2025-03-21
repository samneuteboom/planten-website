<?php
$host = "localhost";
$user = "root"; // Standaard bij XAMPP
$pass = "";
$dbname = "plantenwinkel";

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die("Database fout: " . $conn->connect_error);
}
?>
