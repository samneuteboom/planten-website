<?php
//---------------------------//
// Naam script     : config.php
// Omschrijving     : het configurerem van de database
// Naam ontwikkelaar : sam
//---------------------------//
?>
<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "plantenwinkel";

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die("Database fout: " . $conn->connect_error);
}
?>
