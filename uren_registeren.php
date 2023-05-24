
<html lang="en">
<head>
  <link rel="stylesheet" href="style.css">
  
  <title>Medewerker</title>
  <style>
    /*style van container van urenregister systeem:*/ 
    .topbar6 .container {
    max-width: 400px;
    margin: 0 auto;
    margin-top: 200px;
    padding: 20px;
    text-align: center;
    background-color: #f9f9f9;
    border: 1px solid #ddd;
    border-radius: 5px;
}
.topbar6 h2 {
      margin-bottom: 20px;
      text-align: center;
      font-size: 35px;
      color: white;
    }

.topbar6 label {
    display: block;
    text-align: left;
    margin-bottom: 5px;
}

.topbar6 input[type="text"],
.topbar6 input[type="password"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}

.topbar6 button {
    background-color: #4CAF50;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

.topbar6 button:hover {
    opacity: 0.8;
}

.topbar6 a {
    text-decoration: none;
    color: #999;
}

.topbar6 a:hover {
    color: #666;
}


/* CSS-styling voor het formulier */
.topbar6 form {
    max-width: 400px;
    margin: 0 auto;
    padding: 20px;
    background-color: #f5f5f5;
    border: 1px solid #ccc;
    border-radius: 4px;
    font-family: Arial, sans-serif;
  }

  .topbar6 label {
    display: block;
    margin-bottom: 10px;
    font-weight: bold;
  }

  .topbar6 input[type="time"],
  .topbar6 input[type="number"],
  .topbar6 input[type="date"],
  .topbar6 input[type="text"],
  .topbar6 textarea {
    width: 100%;
    padding: 8px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
    font-size: 14px;
  }

  .topbar6 .extarea {
    resize: vertical;
  }

  .topbar6 button[type="submit"] {
    background-color: #4CAF50;
    color: #fff;
    padding: 10px 16px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 14px;
  }

  button[type="submit"]:hover {
    background-color: #45a049;
  }
  </style>
</head>
<body>
<div class=topbar6>
  <h2>Gewerkte uren </h2>
  
 <!-- Links menu voor zoekpagina -->
<form action="uren_registeren.php" method="POST">
  <label for="werktijd">Werktijd (begin - einde):</label>
  <input type="text" id="werktijd" name="werktijd" required>
  <br>
  <label for="eindtijd">Eindtijd:</label>
  <input type="time" id="eindtijd" name="eindtijd" required>
  <label for="uren">Uren:</label>
  <input type="number" id="uren" name="uren" min="0" required><br>
  <label for="datum">Datum:</label>
  <input type="date" id="datum" name="datum" required><br>
  <label for="bedrijf">Bedrijf:</label>
  <input type="text" id="bedrijf" name="bedrijf" required>
  <label for="taak">Taak:</label>
  <input type="text" id="taak" name="taak" required>
  <br>
  <label for="opmerking">Opmerking:</label>
  <textarea id="opmerking" name="opmerking"></textarea>
  <br>
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
