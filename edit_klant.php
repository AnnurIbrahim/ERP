<?php
// Databaseverbinding
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "us3/4";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
  die("Verbinding mislukt: " . mysqli_connect_error());
}

// Haal de klantgegevens op basis van de ID uit de database
$ID=  $_GET['ID'];
$sql = "SELECT * FROM klanten WHERE ID=$ID";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

// Wanneer het formulier wordt ingediend
if (isset($_POST['submit'])) {
  // Gebruik voorbereide verklaringen om SQL-injecties te voorkomen
  $stmt = $conn->prepare("UPDATE klanten SET bedrijfsnaam=?, voornaam=?, tussenvoegsel=?, achternaam=?, functie=?, email=?, telefoonnummer=?, adres=? WHERE ID=?");
  $stmt->bind_param("ssssssssi", $_POST['bedrijfsnaam'], $_POST['voornaam'], $_POST['tussenvoegsel'], $_POST['achternaam'], $_POST['functie'], $_POST['email'], $_POST['telefoonnummer'], $_POST['adres'], $ID);

  // Voer de update-query uit
  if ($stmt->execute()) {
    // Voeg beveiliging toe om te voorkomen dat kwaadwillende gebruikers toegang krijgen tot gevoelige klantgegevens
    session_start();
    if ($_SESSION['gebruikersnaam'] !== 'admin') {
      die("Alleen een beheerder heeft toegang tot deze pagina.");
    }

    // Geef een melding weer aan de gebruiker wanneer de gegevens zijn bijgewerkt
    echo "Klantgegevens zijn succesvol bijgewerkt.";
  } else {
    echo "Fout bij updaten record: " . $stmt->error;
  }

  // Sluit de verbinding
  $stmt->close();
  mysqli_close($conn);
}

?>