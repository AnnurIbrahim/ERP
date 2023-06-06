<head>
  <link rel="stylesheet" href="uren.css">
  <title>Medewerker</title>
  <style>
    .bedrijf-input {
      /* Voeg hier je gewenste opmaakstijlen toe */
      border: 1px solid #ccc;
      padding: 8px;
      border-radius: 4px;
      font-size: 100%;
      width: 100%;
      /* Andere gewenste stijlen */
    }
  </style>
</head>
<body>
  <div class="topbar6">
    <h2>Gewerkte uren</h2>
  
    <!-- Formulier voor het registreren van uren -->
    <form action="uren_registeren.php" method="POST">
      <label for="werktijd">Werktijd (begin - einde):</label>
      <input type="text" id="werktijd" name="werktijd" required><br>
      <label for="eindtijd">Eindtijd:</label>
      <input type="time" id="eindtijd" name="eindtijd" required><br>
      <label for="uren">Uren:</label>
      <input type="number" id="uren" name="uren" min="0" required><br>
      <label for="datum">Datum:</label>
      <input type="date" id="datum" name="datum" required><br>
      <label for="bedrijf">Bedrijf:</label>
      <select id="bedrijf" name="bedrijf" class="bedrijf-input" required>
        <?php
        // Database credentials
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "us3/4"; // Corrected table name, assuming it's "us3_4"

        // Maak verbinding met de database
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Controleer de verbinding
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Bereid de SQL-query voor om bedrijfsgegevens op te halen
        $bedrijvenQuery = "SELECT bedrijfsnaam FROM klanten";
        $result = $conn->query($bedrijvenQuery);

        // Itereer over de resultaten van de query en voeg de bedrijven toe aan het select-element
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $bedrijfNaam = $row["bedrijfsnaam"];
                echo "<option value='$bedrijfNaam'>$bedrijfNaam</option>";
            }
        }

        // Sluit de databaseverbinding
        $conn->close();
        ?>
      </select><br>
      <label for="taak">Taak:</label>
      <input type="text" id="taak" name="taak" required><br>
      <label for="opmerking">Opmerking:</label>
      <textarea id="opmerking" name="opmerking"></textarea><br>
      <button type="submit">Opslaan</button>
    </form>
  </div>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Haal de ingevulde waarden op
    $uren = $_POST["uren"];
    $datum = $_POST["datum"];
    $werktijd = $_POST["werktijd"];
    $bedrijf = $_POST["bedrijf"];
    $taak = $_POST["taak"];
    $opmerking = $_POST["opmerking"];

    // Dit code bereken begin- en eindtijd van de werktijd
    $werktijdArray = explode(" - ", $werktijd);
    $beginTijd = isset($werktijdArray[0]) ? $werktijdArray[0] : '';
    $eindTijd = isset($werktijdArray[1]) ? $werktijdArray[1] : '';

    // Database credentials
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "us3/4"; // Corrected table name, assuming it's "us3_4"

    // Maak verbinding met de database
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Controleer de verbinding
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Bereid de SQL-query voor om de gegevens in de database op te slaan
    $sql = $conn->prepare("INSERT INTO Uren (uren, datum, begin_tijd, eind_tijd, bedrijf, taak, opmerking) VALUES (?, ?, ?, ?, ?, ?, ?)");

    // Bind de waarden aan de SQL-query en voorkom SQL-injecties
    $sql->bind_param("sssssss", $uren, $datum, $beginTijd, $eindTijd, $bedrijf, $taak, $opmerking);

    // Voer de query uit en controleer of het succesvol was
    if ($sql->execute()) {
        // Geen echo meer hier, code zonder succesbericht
    } else {
        echo "Fout bij het opslaan van gegevens: " . $sql->error;
    }

    // Sluit de databaseverbinding
    $conn->close();
}
?>

