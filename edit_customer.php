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

// Wanneer het formulier wordt ingediend
if (isset($_POST['submit'])) {
  // Loop door alle klanten en update de gegevens
  foreach ($_POST['klant'] as $key => $value) {
    $id = $key;
    $bedrijfsnaam = $value['bedrijfsnaam'];
    $voornaam = $value['voornaam'];
    $tussenvoegsel = $value['tussenvoegsel'];
    $achternaam = $value['achternaam'];
    $functie = $value['functie'];
    $email = $value['email'];
    $telefoonnummer = $value['telefoonnummer'];
    $adres = $value['adres'];

    // Update de klantgegevens in de database op basis van de ID
    $sql = "UPDATE klanten SET bedrijfsnaam='$bedrijfsnaam', voornaam='$voornaam', tussenvoegsel='$tussenvoegsel', achternaam='$achternaam', functie='$functie', email='$email', telefoonnummer='$telefoonnummer', adres='$adres' WHERE ID=$id";

    if (mysqli_query($conn, $sql)) {
      echo "Klantgegevens zijn succesvol bijgewerkt voor klant met ID: $id<br>";
    } else {
      echo "Error updating record for klant met ID: $id - " . mysqli_error($conn) . "<br>";
    }
  }
}

// Haal alle klantgegevens op uit de database
$sql = "SELECT * FROM klanten";
$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html>
<head>
  <title>Klantgegevens bewerken</title>
  <link rel="stylesheet" href="customer.css">
</head>
<body>
<div class="container">
<h2>Klantgegevens bewerken</h2>

<form method="post">
  <label>Selecteer een klant:</label><br>
  <select name="klant" onchange="this.form.submit()">
    <?php
    // Toon de lijst met klanten
    if (mysqli_num_rows($result) > 0) {
      while ($row = mysqli_fetch_assoc($result)) {
        echo '<option value="' . $row['ID'] . '">' . $row['bedrijfsnaam'] . '</option>';
      }
    } else {
      echo '<option value="">Geen klanten beschikbaar</option>';
    }
    ?>
  </select><br>
</form>

<?php
// Controleer of het formulier is ingediend en een klant is geselecteerd
if (isset($_POST['klant'])) {
  $selectedCustomerID = $_POST['klant'];

// Haal de gegevens van de geselecteerde klant op
$sql = "SELECT * FROM klanten WHERE ID='$selectedCustomerID'";
$result = mysqli_query($conn, $sql);
$customerData = mysqli_fetch_assoc($result);

// Sluit de databaseverbinding
mysqli_close($conn);

// Controleer of er klantgegevens zijn gevonden
if ($customerData) {
echo '<form method="post">';
echo '<input type="hidden" name="klant[ID]" value="' . $customerData['ID'] . '">';
echo '<label>Bedrijfsnaam:</label><br>';
echo '<input type="text" name="klant[bedrijfsnaam]" value="' . $customerData['bedrijfsnaam'] . '"><br>';
echo '<label>Voornaam:</label><br>';
echo '<input type="text" name="klant[voornaam]" value="' . $customerData['voornaam'] . '"><br>';
echo '<label>Tussenvoegsel:</label><br>';
echo '<input type="text" name="klant[tussenvoegsel]" value="' . $customerData['tussenvoegsel'] . '"><br>';
echo '<label>Achternaam:</label><br>';
echo '<input type="text" name="klant[achternaam]" value="' . $customerData['achternaam'] . '"><br>';
echo '<label>Functie:</label><br>';
echo '<input type="text" name="klant[functie]" value="' . $customerData['functie'] . '"><br>';
echo '<label>Email:</label><br>';
echo '<input type="text" name="klant[email]" value="' . $customerData['email'] . '"><br>';
echo '<label>Telefoonnummer:</label><br>';
echo '<input type="text" name="klant[telefoonnummer]" value="' . $customerData['telefoonnummer'] . '"><br>';
echo '<label>Adres:</label><br>';
echo '<input type="text" name="klant[adres]" value="' . $customerData['adres'] . '"><br>';
echo '<input type="submit" name="submit" value="Opslaan">';
echo '</form>';
} else {
echo "Geen klantgegevens gevonden.";
}
}
// Dit is  het formulier om een nieuwe klant toe te voegen
echo '<h3>Nieuwe klant toevoegen</h3>';
echo '<form method="post">';
echo '<label>Bedrijfsnaam:</label><br>';
echo '<input type="text" name="newKlant[bedrijfsnaam]"><br>';
echo '<label>Voornaam:</label><br>';
echo '<input type="text" name="newKlant[voornaam]"><br>';
echo '<label>Tussenvoegsel:</label><br>';
echo '<input type="text" name="newKlant[tussenvoegsel]"><br>';
echo '<label>Achternaam:</label><br>';
echo '<input type="text" name="newKlant[achternaam]"><br>';
echo '<label>Functie:</label><br>';
echo '<input type="text" name="newKlant[functie]"><br>';
echo '<label>Email:</label><br>';
echo '<input type="text" name="newKlant[email]"><br>';
echo '<label>Telefoonnummer:</label><br>';
echo '<input type="text" name="newKlant[telefoonnummer]"><br>';
echo '<label>Adres:</label><br>';
echo '<input type="text" name="newKlant[adres]"><br>';
echo '<input type="submit" name="submitNewKlant" value="Toevoegen">';
echo '</form>';

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
    echo "Nieuwe klant is succesvol toegevoegd.";
  } else {
    echo "Fout bij het toevoegen van de klant: " . mysqli_stmt_error($stmt);
  }

  // Sluiten van de prepared statement
  mysqli_stmt_close($stmt);
}

?>

    
</body>
</html>