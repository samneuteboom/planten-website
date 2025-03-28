<?php
//---------------------------//
// Naam script     : logout.php
// Omschrijving     : deze pagina is er voor dat je kan uitloggen wanneer je bent ingelogd op een acount
// Naam ontwikkelaar : sam
//---------------------------//
?>

<?php
session_start();
session_destroy();
header("Location: index.html");
exit();
?>
