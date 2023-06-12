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
  ?>
  <!DOCTYPE html>
  <html>
  <head>
    <title>Klantgegevens bewerken</title>
    <link rel="stylesheet" href="customer.css"> 
  </head>
  <body>
  <div class="container">
  <div class="card card-header-primary">
    <h2>Klantgegevens bewerken</h2>
    </div>
  <?php
          // Wanneer het formulier wordt ingediend
          if (isset($_POST['submit'])) {
            // Loop door alle klanten en update de gegevens
            $id = $_POST['klant']['ID'];
            $bedrijfsnaam = $_POST['klant']['bedrijfsnaam'];
            $voornaam = $_POST['klant']['voornaam'];
            $tussenvoegsel = $_POST['klant']['tussenvoegsel'];
            $achternaam =$_POST['klant']['achternaam'];
            $functie = $_POST['klant']['functie'];
            $email = $_POST['klant']['email'];
            $telefoonnummer = $_POST['klant']['telefoonnummer'];
            $adres = $_POST['klant']['adres'];

            // Update de klantgegevens in de database op basis van de ID
            $sql = "UPDATE klanten SET bedrijfsnaam='$bedrijfsnaam', voornaam='$voornaam', tussenvoegsel='$tussenvoegsel', achternaam='$achternaam', functie='$functie', email='$email', telefoonnummer='$telefoonnummer', adres='$adres' WHERE ID=$id";

          if (mysqli_query($conn, $sql)) {
            if (mysqli_affected_rows($conn) > 0) {
              echo "Klantgegevens zijn succesvol bijgewerkt voor klant met ID: $id<br>";
            } else {
              echo "Geen wijzigingen aangebracht voor klant met ID: $id<br>";
            }
          } else {
            echo "Error updating record for klant met ID: $id - " . mysqli_error($conn) . "<br>";
          }
        }
        // Haal alle klantgegevens op uit de database
        $sql = "SELECT * FROM klanten";
        $result = mysqli_query($conn, $sql);

  ?>
    <form method="post">
    <label>Selecteer een klant:</label><br>
    <select name="klant[ID]" onchange="this.form.submit()">
  <?php
      // Toon de lijst met klanten
      $selectedCustomerID = isset($_POST['klant']['ID']) ? $_POST['klant']['ID'] : '';
      if (mysqli_num_rows($result) > 0) {
        // Eerste optie zonder geselecteerde waarde
        echo '<option value="">Selecteer een klant</option>';

        while ($row = mysqli_fetch_assoc($result)) {
          $selected = ($row['ID'] == $selectedCustomerID) ? 'selected' : '';
          echo '<option value="' . $row['ID'] . '" ' . $selected . '>' . $row['bedrijfsnaam'] . '</option>';
        }
      } else {
        echo '<option value="">Geen klanten beschikbaar</option>';
      }
  ?>
    </select><br>
  </form>

        <?php
        // Controleer of het formulier is ingediend en een klant is geselecteerd
        if (isset($_POST['klant']))  {
          $selectedCustomerID = $_POST['klant']['ID'];
          // Haal de gegevens van de geselecteerde klant op
          $sql = "SELECT * FROM klanten WHERE ID='$selectedCustomerID'";
            $result = mysqli_query($conn, $sql);
              $customerData = mysqli_fetch_assoc($result); //deze code haalt de gegevens op van de geselecteerde klant 
          // Controleer of er klantgegevens zijn gevonden
      if ($customerData && !empty($customerData)) {
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
      // Sluit de databaseverbinding
      mysqli_close($conn);
      ?>  