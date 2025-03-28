<?php
//---------------------------//
// Naam script     : register.php
// Omschrijving     : de pagina waar je kan registreren
// Naam ontwikkelaar : sam
//---------------------------//
?>

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
        // **Stap 1: Controleer of de gebruikersnaam al bestaat**
        $stmt = $conn->prepare("SELECT id FROM gebruikers WHERE gebruikersnaam = ?");
        $stmt->bind_param("s", $gebruikersnaam);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $error = "Deze gebruikersnaam is al in gebruik. Kies een andere.";
        } else {
            // **Stap 2: Hash het wachtwoord en sla gebruiker op**
            $hashed_password = password_hash($wachtwoord, PASSWORD_DEFAULT);
            $stmt = $conn->prepare("INSERT INTO gebruikers (gebruikersnaam, wachtwoord) VALUES (?, ?)");
            $stmt->bind_param("ss", $gebruikersnaam, $hashed_password);

            if ($stmt->execute()) {
                header("Location: inlog.php"); // Stuur door naar loginpagina
                exit();
            } else {
                $error = "Fout bij registratie. Probeer het later opnieuw.";
            }
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
