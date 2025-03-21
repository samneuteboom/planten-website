<?php
session_start();
include "config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $gebruikersnaam = $_POST["gebruikersnaam"];
    $wachtwoord = $_POST["wachtwoord"];

    $sql = "SELECT id, wachtwoord FROM gebruikers WHERE gebruikersnaam = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $gebruikersnaam);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($id, $hashed_wachtwoord);
    $stmt->fetch();

    if ($stmt->num_rows > 0 && password_verify($wachtwoord, $hashed_wachtwoord)) {
        $_SESSION["user"] = $gebruikersnaam;
        header("Location: dashboard.php");
        exit();
    } else {
        echo "Onjuiste inloggegevens!";
    }
}
?>

<form method="POST">
    <input type="text" name="gebruikersnaam" placeholder="Gebruikersnaam" required><br>
    <input type="password" name="wachtwoord" placeholder="Wachtwoord" required><br>
    <button type="submit">Inloggen</button>
</form>
