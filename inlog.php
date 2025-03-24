<?php
session_start();
$loginError = "";

// Controleer of het formulier is verzonden
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require "config.php"; // Databaseverbinding

    $gebruikersnaam = trim($_POST["gebruikersnaam"]);
    $wachtwoord = trim($_POST["wachtwoord"]);

    if (!empty($gebruikersnaam) && !empty($wachtwoord)) {
        // Zoek gebruiker in database
        $stmt = $conn->prepare("SELECT id, gebruikersnaam, wachtwoord FROM gebruikers WHERE gebruikersnaam = ?");
        $stmt->bind_param("s", $gebruikersnaam);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            // Controleer wachtwoord
            if (password_verify($wachtwoord, $row["wachtwoord"])) {
                $_SESSION["gebruiker"] = $row["gebruikersnaam"];
                header("Location: homepage.php");
                exit();
            } else {
                $loginError = "Ongeldige gebruikersnaam of wachtwoord.";
            }
        } else {
            $loginError = "Ongeldige gebruikersnaam of wachtwoord.";
        }
    } else {
        $loginError = "Vul alle velden in.";
    }
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Plantenwinkel</title>
    <link rel="stylesheet" href="css/inlog.css">
</head>
<body>

    <nav>
        <h2>Plantenwinkel</h2>
    </nav>

    <div class="container" id="loginPage">
        <h3>Login</h3>
        <div class="login-box">
            <?php if ($loginError): ?>
                <p class="error"><?= $loginError ?></p>
            <?php endif; ?>
            <form method="post" action="">
                <input type="text" name="gebruikersnaam" placeholder="Gebruikersnaam">
                <input type="password" name="wachtwoord" placeholder="Wachtwoord">
                <div class="btn-group">
                    <button type="submit">Inloggen</button>
                    <button type="button" onclick="location.href='index.html'">Terug naar homepage</button>
                </div>
            </form>
        </div>
    </div>

</body>
</html>
