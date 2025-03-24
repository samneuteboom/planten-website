<?php
require 'config.php'; // Databaseverbinding

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $gebruikersnaam = trim($_POST["gebruikersnaam"]);
    $wachtwoord = trim($_POST["wachtwoord"]);
    $bevestig_wachtwoord = trim($_POST["bevestig_wachtwoord"]);

    // Controleer of wachtwoorden overeenkomen
    if ($wachtwoord !== $bevestig_wachtwoord) {
        $error = "Wachtwoorden komen niet overeen!";
    } else {
        // Hash het wachtwoord
        $hashed_password = password_hash($wachtwoord, PASSWORD_DEFAULT);

        // Voeg de gebruiker toe aan de database
        $stmt = $conn->prepare("INSERT INTO users (gebruikersnaam, wachtwoord) VALUES (?, ?)");
        $stmt->bind_param("ss", $gebruikersnaam, $hashed_password);

        if ($stmt->execute()) {
            header("Location: login.php"); // Stuur door naar loginpagina
            exit();
        } else {
            $error = "Fout bij registratie. Probeer een andere gebruikersnaam.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registreren - Plantenwinkel</title>
    <link rel="stylesheet" href="css/register.css">
</head>
<body>

    <nav>
        <h2>Plantenwinkel</h2>
    </nav>

    <div class="container">
        <h3>Registreren</h3>
        <?php if (isset($error)) echo "<p style='color: red;'>$error</p>"; ?>
        <form action="register.php" method="POST">
            <input type="text" name="gebruikersnaam" placeholder="Gebruikersnaam" required>
            <input type="password" name="wachtwoord" placeholder="Wachtwoord" required>
            <input type="password" name="bevestig_wachtwoord" placeholder="Bevestig Wachtwoord" required>
            <div class="btn-group">
                <button type="submit">Registreren</button>
                <button type="button" onclick="location.href='index.html'">Terug naar homepage</button>
            </div>
        </form>
    </div>

</body>
</html>
