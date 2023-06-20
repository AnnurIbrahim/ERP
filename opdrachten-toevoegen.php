<?php
session_start();

// Controleer of de gebruiker is ingelogd
if (!isset($_SESSION['Voornaam'])) {
    header('Location: Login.php');
    exit;
}

// Controleer of het formulier is ingediend
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ontvang de gegevens van het formulier
    $klantnaam = $_POST["klantnaam"];
    $titel = $_POST["titel"];
    $omschrijving = $_POST["omschrijving"];
    $aanvraagdatum = $_POST["aanvraagdatum"];
    $kennis = $_POST["kennis"];

    // Database credentials
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "us3/4";

    // Maak verbinding met de database
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Controleer de verbinding
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Voeg de opdracht toe aan de database
    $sql = "INSERT INTO Opdrachten (Klantnaam, Titel, Omschrijving, Aanvraagdatum, Kennis)
            VALUES ('$klantnaam', '$titel', '$omschrijving', '$aanvraagdatum', '$kennis')";

    if ($conn->query($sql) === TRUE) {
        // Opdracht succesvol toegevoegd, stuur de gebruiker terug naar Opdrachten.php
        header('Location: Opdrachten.php');
        exit;
    } else {
        echo "Fout bij het toevoegen van de opdracht: " . $conn->error;
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="Nieuwklant.css">
    <title>Document</title>
</head>
<body>
<h2>Opdrachten toevoegen</h2>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
    <label for="klantnaam">Klantnaam:</label>
    <input type="text" id="klantnaam" name="klantnaam" required><br><br>

    <label for="titel">Titel:</label>
    <input type="text" id="titel" name="titel" required><br><br>

    <label for="omschrijving">Omschrijving:</label>
    <textarea id="omschrijving" name="omschrijving" required></textarea><br><br>

    <label for="aanvraagdatum">Aanvraagdatum:</label>
    <input type="date" id="aanvraagdatum" name="aanvraagdatum" required><br><br>

    <label for="kennis">Kennis:</label>
    <input type="text" id="kennis" name="kennis" required><br><br>

    <button type="submit">Toevoegen</button>
</form>
</body>
</html>