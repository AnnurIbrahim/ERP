<!DOCTYPE html>
<html>
<head>
  <title>Nieuwe klant toevoegen</title>
  <link rel="stylesheet" type="text/css" href="Nieuwklant.css">
  <style>
  
  </style>
</head>
<body>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "us3/4";

// Maak verbinding met de database
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Controleer de verbinding
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

$message = '';

// Wanneer het formulier voor het toevoegen van een nieuwe klant wordt ingediend
if (isset($_POST['submitNewKlant'])) {
  $newKlantData = $_POST['newKlant'];
  $newBedrijfsnaam = $newKlantData['bedrijfsnaam'];
  $newVoornaam = $newKlantData['voornaam'];
  $newTussenvoegsel = $newKlantData['tussenvoegsel'];
  $newAchternaam = $newKlantData['achternaam'];
  $newFunctie = $newKlantData['functie'];
  $newEmail = $newKlantData['email'];
  $newTelefoonnummer = $newKlantData['telefoonnummer'];
  $newAdres = $newKlantData['adres'];

  // Voorbereiden van de SQL-instructie met een prepared statement
  $stmt = mysqli_prepare($conn, "INSERT INTO klanten (bedrijfsnaam, voornaam, tussenvoegsel, achternaam, functie, email, telefoonnummer, adres) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

  // Binding maken van de parameters aan de prepared statement
  mysqli_stmt_bind_param($stmt, "ssssssss", $newBedrijfsnaam, $newVoornaam, $newTussenvoegsel, $newAchternaam, $newFunctie, $newEmail, $newTelefoonnummer, $newAdres);

  // Uitvoeren van de prepared statement
  if (mysqli_stmt_execute($stmt)) {
  $message = "Nieuwe klant is succesvol toegevoegd.";
  } else {
  $message = "Fout bij het toevoegen van de klant: " . mysqli_stmt_error($stmt);
  }
  
  // Sluit de prepared statement
  mysqli_stmt_close($stmt);
  
  // Sluit de databaseverbinding
  mysqli_close($conn);
  }
  ?>
  
  <h3>Nieuwe klant toevoegen</h3>
  <form method="post">
    <label>Bedrijfsnaam:</label><br>
    <input type="text" name="newKlant[bedrijfsnaam]" required><br>
    <label>Voornaam:</label><br>
    <input type="text" name="newKlant[voornaam]" required><br>
    <label>Tussenvoegsel:</label><br>
    <input type="text" name="newKlant[tussenvoegsel]"><br>
    <label>Achternaam:</label><br>
    <input type="text" name="newKlant[achternaam]" required><br>
    <label>Functie:</label><br>
    <input type="text" name="newKlant[functie]"><br>
    <label>Email:</label><br>
    <input type="text" name="newKlant[email]" required><br>
    <label>Telefoonnummer:</label><br>
    <input type="text" name="newKlant[telefoonnummer]" required><br>
    <label>Adres:</label><br>
    <input type="text" name="newKlant[adres]" required><br>
    <input type="submit" name="submitNewKlant" value="Toevoegen">
  </form>
  <div class="message">
    <?php echo $message; ?>
  </div>
  </body>
  </html>