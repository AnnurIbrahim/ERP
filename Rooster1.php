<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" href="style.css">
  <title>Rooster</title>
  <style>
    table {
  margin-top: 20px;
  border-collapse: collapse;
  width: 10%;
  font-size: 20px;
  
}

th, td {
  padding: 9px;
  text-align: left;
  border-bottom: 2px solid #ddd;
}

th {
  background-color: #f2f2f;
}
 /* Optioneel: pas de stijl aan zoals gewenst */
 .employee-info {
      margin-top: 10px;
      font-weight: bold;
    }
  </style>
</head>
<body>
  <h1>Medewerkers</h1>

  <div class="topbar6"></div>

  <!-- Zoekformulier -->
  <form action="Medewerkers.php" method="GET">
    <label for="zoekterm">Zoeken</label>
    <input type="text" id="zoekterm" name="zoekterm">
    <button type="submit">Zoeken</button>
    <label for="dag">Dag</label>
    <input type="date" id="dag" name="dag">

    <label for="week">Week</label>
    <input type="week" id="week" name="week">

    <label for="maand">Maand</label>
    <select id="maand" name="maand">
      <option value="1">Januari</option>
      <option value="2">Februari</option>
      <option value="3">Maart</option>
      <option value="4">April</option>
      <option value="5">Mei</option>
      <option value="6">Juni</option>
      <option value="7">Juli</option>
      <option value="8">Augustus</option>
      <option value="9">September</option>
      <option value="10">Oktober</option>
      <option value="11">November</option>
      <option value="12">December</option>
    </select>
    <label for="medewerker">Medewerker</label>
    <select id="medewerker" name="medewerker">
      <option value="1">Medewerker 1</option>
      <option value="2">Medewerker 2</option>
      <option value="3">Medewerker 3</option>
      <!-- Voeg hier de rest van de medewerkers toe -->
    </select>
  </form>

  <?php
  // Connectie met de database
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "us3/4"; // naam van de database
  $conn = mysqli_connect($servername, $username, $password, $dbname);

  // Verbinding controleren
  if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
  }

  // Zoeken op basis van medewerker-ID, dag, week of maand
  if (isset($_GET['zoekterm']) && isset($_GET['dag'])) {
      $zoekterm = $_GET['zoekterm'];
      $dag = $_GET['dag'];

      $sql = "SELECT * FROM Rooster WHERE MedewerkerID = '$zoekterm' AND (maandag = '$dag' OR dinsdag = '$dag' OR woensdag = '$dag' OR donderdag = '$dag' OR vrijdag = '$dag' OR zaterdag = '$dag' OR zondag = '$dag')";
      $result = mysqli_query($conn, $sql);
  } elseif (isset($_GET['zoekterm']) && isset($_GET['week'])) {
    $zoekterm = $_GET['zoekterm'];
    $week = $_GET['week'];

    $sql = "SELECT * FROM Rooster WHERE MedewerkerID = '$zoekterm' AND (maandag BETWEEN '$week' AND DATE_ADD('$week', INTERVAL 6 DAY))";
    $result = mysqli_query($conn, $sql);
} elseif (isset($_GET['zoekterm']) && isset($_GET['maand'])) {
    $zoekterm = $_GET['zoekterm'];
    $maand = $_GET['maand'];

    $sql = "SELECT SEC_TO_TIME(SUM(TIME_TO_SEC(STR_TO_DATE(maandag, '%H:%i:%s')) + TIME_TO_SEC(STR_TO_DATE(dinsdag, '%H:%i:%s')) + TIME_TO_SEC(STR_TO_DATE(woensdag, '%H:%i:%s')) + TIME_TO_SEC(STR_TO_DATE(donderdag, '%H:%i:%s')) + TIME_TO_SEC(STR_TO_DATE(vrijdag, '%H:%i:%s')) + TIME_TO_SEC(STR_TO_DATE(zaterdag, '%H:%i:%s')) + TIME_TO_SEC(STR_TO_DATE(zondag, '%H:%i:%s')))) AS totaal_uren FROM Rooster WHERE MedewerkerID = '$zoekterm' AND (MONTH(maandag) = '$maand' OR MONTH(dinsdag) = '$maand' OR MONTH(woensdag) = '$maand' OR MONTH(donderdag) = '$maand' OR MONTH(vrijdag) = '$maand' OR MONTH(zaterdag) = '$maand' OR MONTH(zondag) = '$maand')";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $totaal_uren = $row['totaal_uren'];
    }
}

$sql = "SELECT * FROM Rooster WHERE MedewerkerID = '$zoekterm' AND (MONTH(maandag) = '$maand' OR MONTH(dinsdag) = '$maand' OR MONTH(woensdag) = '$maand' OR MONTH(donderdag) = '$maand' OR MONTH(vrijdag) = '$maand' OR MONTH(zaterdag) = '$maand' OR MONTH(zondag) = '$maand')";
$result = mysqli_query($conn, $sql);

// Alle medewerkers weergeven als er geen zoekopdracht is
if (!isset($_GET['zoekterm'])) {
    $sql = "SELECT * FROM Rooster";
    $result = mysqli_query($conn, $sql);
}

// Resultaten weergeven
if (mysqli_num_rows($result) > 0) {
    echo "<table>";
    echo "<tr><th>ID</th><th>MedewerkerID</th><th>Maandag</th><th>Dinsdag</th><th>Woensdag</th><th>Donderdag</th><th>Vrijdag</th><th>Zaterdag</th><th>Zondag</th></tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr><form action='update_rooster1.php' method='POST'>";
        echo "<td>" . $row["ID"] . "</td>";
        echo "<td>" . $row["MedewerkerID"] . "</td>";
        echo "<td><input type='text' name='maandag' value='" . $row["maandag"] . "'></td>";
        echo "<td><input type='text' name='dinsdag' value='" . $row["dinsdag"] . "'></td>";
        echo "<td><input type='text' name='woensdag' value='" . $row["woensdag"] . "'></td>";
        echo "<td><input type='text' name='donderdag' value='" . $row["donderdag"] . "'></td>";
        echo "<td><input type='text' name='vrijdag' value='" . $row["vrijdag"] . "'></td>";
        echo "<td><input type='text' name='zaterdag' value='" . $row["zaterdag"] . "'></td>";
        echo "<td><input type='text' name='zondag' value='" . $row["zondag"] . "'></td>";
        echo "<td><button type='submit'>Opslaan</button></td>";
        echo "</form></tr>";
    }
    
    echo "</table>";
}   
// Totaal geplande uren weergeven
if (isset($totaal_uren)) {
    echo "<p>Totaal geplande uren voor de maand: " . $totaal_uren . "</p>";
}

mysqli_close($conn);
?>
