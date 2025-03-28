<?php
//---------------------------//
// Naam script     : homepage.php      // Homepagina na inloggen
// Omschrijving     : Welkomstpagina voor ingelogde gebruikers // Verwelkomt ingelogde gebruiker
// Naam ontwikkelaar : sam en semere   // Ontwikkelaars
//---------------------------//
?>

<?php
session_start(); // Start of hervat sessie
require 'config.php'; // Verbindt met de database

if (!isset($_SESSION["gebruiker"])) { // Controleer of de gebruiker is ingelogd
    header("Location: login.php"); // Redirect naar login als niet ingelogd
    exit();
}

$gebruikersnaam = $_SESSION["gebruiker"]; // Haal gebruikersnaam op uit sessie
$stmt = $conn->prepare("SELECT gebruikersnaam FROM gebruikers WHERE gebruikersnaam = ?"); // Bereid SQL-query voor
$stmt->bind_param("s", $gebruikersnaam); // Bind de parameter voor de query
$stmt->execute(); // Voer de query uit
$result = $stmt->get_result(); // Verkrijg het resultaat van de query
$user = $result->fetch_assoc(); // Haal gebruikersgegevens op
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
        <h2>Plantenwinkel</h2> <!-- Navigatie-header -->
    </nav>

    <div class="container">
        <h2>Welkom <?php echo htmlspecialchars($user['gebruikersnaam']); ?> bij de plantenwinkel</h2> <!-- Welkomstbericht met gebruikersnaam -->
        <p>Koop de mooiste planten voor binnen en buiten. Wij bieden een breed assortiment aan kamerplanten en exotische planten.</p>

        <h3>Onze collecties</h3>
        
        <div class="collection-list">
            <div class="collection-item">Kamerplanten - Goed voor in het huis of in het kantoor</div>
            <div class="collection-item">Tuinplanten - Ideaal voor in de tuin</div>
            <div class="collection-item">Cactussen - Weinig onderhoud nodig</div>
            <div class="collection-item">Exotische planten - Unieke soorten te vinden over de hele wereld</div>
        </div>

        <p>Bij Plantenwinkel streven we naar de beste kwaliteit en bieden we deskundig advies over de verzorging van uw planten.</p>

        <div class="btn-group">
            <button onclick="location.href='logout.php'">Uitloggen</button> <!-- Knop om uit te loggen -->
            <button onclick="location.href='shop.php'">Bekijk planten</button> <!-- Knop om de plantenwinkel te bekijken -->
        </div>
    </div>

</body>
</html>
