<?php
//---------------------------//
// Naam script     : logout.php      // Script om uit te loggen
// Omschrijving     : Uitloggen bij account // Verantwoordelijk voor uitloggen
// Naam ontwikkelaar : sam           // Ontwikkelaar
//---------------------------//
?>

<?php
session_start(); // Start of hervat sessie
session_destroy(); // Vernietig sessie (uitloggen)
header("Location: index.html"); // Redirect naar homepage
exit(); // Stop het script
?>
