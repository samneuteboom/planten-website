<?php
session_start();
include "config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $gebruikersnaam = $_POST["gebruikersnaam"];
    $wachtwoord = password_hash($_POST["wachtwoord"], PASSWORD_DEFAULT);

    $sql = "INSERT INTO gebruikers (gebruikersnaam, wachtwoord) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $gebruikersnaam, $wachtwoord);

    if ($stmt->execute()) {
        echo "Registratie geslaagd! <a href='inlog.php'>Log in</a>";
    } else {
        echo "Fout: Gebruikersnaam bestaat al!";
    }
}
?>

<form method="POST">
    <input type="text" name="gebruikersnaam" placeholder="Gebruikersnaam" required><br>
    <input type="password" name="wachtwoord" placeholder="Wachtwoord" required><br>
    <button type="submit">Registreren</button>
</form>
