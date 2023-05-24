<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname= "us3/4";
$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

if(isset($_GET['zoekterm'])) {
    $zoekterm = $_GET['zoekterm'];

    $sql = "SELECT * FROM klanten WHERE ID LIKE '%$zoekterm%' OR bedrijfsnaam LIKE '%$zoekterm%' OR voornaam LIKE '%$zoekterm%' OR tussenvoegsel LIKE '%$zoekterm%' OR achternaam LIKE '%$zoekterm%' OR functie LIKE '%$zoekterm%' OR email LIKE '%$zoekterm%' OR telefoonnummer LIKE '%$zoekterm%' OR adres LIKE '%$zoekterm%'";
    $result = mysqli_query($conn, $sql);
} else {
    // anders haal alle klanten op
    $sql = "SELECT ID, bedrijfsnaam, voornaam, tussenvoegsel, achternaam, functie, email, telefoonnummer, adres FROM klanten";
    $result = mysqli_query($conn, $sql);
}
?>
<!DOCTYPE html>
<html>
  <head>
  <link rel="stylesheet" type="text/css" href="style.css">
    <meta charset="UTF-8">
    <title>Zoeken</title>
  </head>
  <body>
  <div class=topbar>
            <a href="Home.php">Home</a>
            <a href="Werkzaamheden.php">Werkzaamheden</a>
            <a href="Klanten.php">Klanten</a>
            <a href="Opdrachten.php">Opdrachten</a>
            <a href="Rooster.php">Rooster</a>
            <a href="Medewerkers.php">Medewerkers</a>
            <a href="Acceptatietest.php">Acceptatietest</a>
            <a href="javascript:void(0);" class="icon" onclick="myFunction()">&#9776;</a>
            <!--Links menu voor zoekpagina-->
    <form action="search.php" method="GET">
    <label for="search">Zoeken</label>
    <input type="text" id="zoekterm" name="zoekterm">
    <button type="submit">Zoeken</button>
    </div>
   </form>
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
    
  </body>
</html>
<?php
    if(mysqli_num_rows($result) > 0) {
        echo "<table>";
        echo "<tr><th>ID</th><th>Bedrijfsnaam</th><th>Voornaam</th><th>Tussenvoegsel</th><th>Achternaam</th><th>Functie</th><th>Email</th><th>Telefoonnummer</th><th>Adres</th></tr>";
        while($row = mysqli_fetch_assoc($result)) {
            echo "<tr><td>".$row['ID']."</td><td>".$row['bedrijfsnaam']."</td><td>".$row['voornaam']."</td><td>".$row['tussenvoegsel']."</td><td>".$row['achternaam']."</td><td>".$row['functie']."</td><td>".$row['email']."</td><td>".$row['telefoonnummer']."</td><td>".$row['adres']."</td></tr>";
        }
        echo "</table>";
    } else {
        echo "Geen resultaten gevonden.";
    }

mysqli_close($conn);
?>

