<?php
session_start();
require 'config.php'; // Databaseverbinding

if (!isset($_SESSION["gebruiker"])) {
    header("Location: login.php");
    exit();
}

$gebruikersnaam = $_SESSION["gebruiker"];
$stmt = $conn->prepare("SELECT gebruikersnaam FROM gebruikers WHERE gebruikersnaam = ?");
$stmt->bind_param("s", $gebruikersnaam);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plantenwinkel</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <nav>
        <h2>Plantenwinkel</h2>
    </nav>

    <div class="container">
    

    <h2>Welkom <?php echo htmlspecialchars($user['gebruikersnaam']); ?> bij de plantenwinkel</h2>
        <p>Koop de mooiste planten voor binnen en buiten. Wij bieden een breed assortiment aan kamerplanten en exotische planten.</p>

        <h3>Onze collecties</h3>
        
        <div class="collection-list">
            <div class="collection-item">Kamerplanten - Perfect voor huis of kantoor</div>
            <div class="collection-item">Tuinplanten - Ideaal voor uw buitenruimten</div>
            <div class="collection-item">Vetplanten & Cactussen - Makkelijk in onderhoud</div>
            <div class="collection-item">Exotische planten - Unieke soorten van over de hele wereld</div>
        </div>
        

        <p>Bij Plantenwinkel streven we naar de beste kwaliteit en bieden we deskundig advies over de verzorging van uw planten.</p>

        <div class="btn-group">
            <button onclick="location.href='logout.php'">Uitloggen</button>
            <button onclick="location.href='shop.php'">Bekijk planten</button>
        </div>
    </div>

</body>
</html>
