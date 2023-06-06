<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname= "us3/4";
$conn = mysqli_connect($servername, $username, $password, $dbname);
// deze code om verbinding te maken met databases. Als de verbinding van de databases mislukt, dan krijgt de gebruiker een duidelijk 
//melding met daarin connection failed door de die() element //
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
/*echo "Connected successfully";*/
/* en ook om specifieke klommen te selecteren uit databases van klanten */
$sql = "SELECT ID,  bedrijfsnaam, voornaam, tussenvoegsel, achternaam, functie, email, telefoonnummer, adres FROM klanten";

$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Klanten</title>
    <link rel="stylesheet" type="text/css" href="annur.css">
</head>
    <body>
        <div class=topbar>
            <a href="Home.php">Home</a>
            <a href="table.php">Werkzaamheden</a>
            <a href="index.php">Klanten</a>
            <a href="Data.php">Opdrachten</a>
            <a href="Rooster.php">Rooster</a>
            <a href="medewerkers.php">Medewerkers</a>
            <a href="connor.php">Acceptatietest</a>
            <a href="javascript:void(0);" class="icon" onclick="myFunction()">&#9776;</a>
            <!--Links menu voor zoekpagina-->
            <form action="/search" method="get">
                <label for="search">Zoeken</label>
                <input type="text" id="search" name="q">
                <button type="submit">Zoeken</button>
            </form>
        </div>
    <script>
    function myFunction() {
        var x = document.getElementsByClassName("topbar")[0];
        if (x.className === "topbar") {
            x.className += " responsive";
        } else {
            x.className = "topbar";
        }
    }
    </script>
    <!-- tabel met onderstaande gegevens voor Html-->
    <table class="my-table">
  <tr>
    <th>ID</th>
    <th>Bedrijfsnaam</th>
    <th>Voornaam</th>
    <th>Tussenvoegsel</th>
    <th>Achternaam</th>
    <th>Functie</th>
    <th>Email</th>
    <th>Telefoonnummer</th>
    <th>Adres</th>
  </tr>
  <?php
    while($row = $result->fetch_assoc()) {
      $id = $row["ID"];
      $bedrijfsnaam = $row["bedrijfsnaam"];
      $voornaam = $row["voornaam"];
      $tussenvoegsel= $row["tussenvoegsel"];
      $achternaam= $row["achternaam"];
      $functie = $row["functie"];
      $email = $row["email"];
      $telefoonnummer = $row["telefoonnummer"];
      $adres = $row["adres"];

      echo "<tr>
                <td>$id</td>
                <td>$bedrijfsnaam</td>
                <td>$voornaam</td>
                <td>$tussenvoegsel</td>
                <td>$achternaam</td>
                <td>$functie</td>
                <td>$email</td>
                <td>$telefoonnummer</td>
                <td>$adres</td>
                </tr>";
    }
  ?>
</table>
</div>
        <?php
        //als er geen rij gevonden heb, dan betekent dat er geen overeenkomst is met databases. 
        //als het geval is dan de String print nu result
        if (mysqli_num_rows($result) == 0) {
            echo "0 results";
        }
        mysqli_close($conn);


    ?>