<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" href="style.css">
  <title>Werkzaamheden</title>
</head>
<body>
<div class=topbar3>
            <a href="Home.php">Home</a>
            <a href="Werkzaamheden.php">Werkzaamheden</a>
            <a href="Klanten.php">Klanten</a>
            <a href="Opdrachten.php">Opdrachten</a>
            <a href="Rooster.php">Rooster</a>
            <a href="Medewerkers.php">Medewerkers</a>
            <a href="Acceptatietest.php">Acceptatietest</a>
            <a href="javascript:void(0);" class="icon" onclick="myFunction()">&#9776;</a>
            <!--Links menu voor zoekpagina-->
            <form action="Werkzaamheden.php" method="get">
                <label for="search">Zoeken</label>
                <input type="text" id="zoekterm" name="zoekterm">
                <button type="submit">Zoeken</button>
            </form>
        </div>
        <script>
        function myFunction() {
            var x = document.getElementsByClassName("topbar3")[0];
            if (x.className === "topbar3") {
                x.className += " responsive";
            } else {
                x.className = "topbar3";
            }
        }
        </script>
    <?php

    // Databasegegevens
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "us3/4";

    // Verbinding maken met de database
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    // Controleren of de verbinding is geslaagd
    if (!$conn) {
        die("Verbinding mislukt: " . mysqli_connect_error());
    }
    
if(isset($_GET['zoekterm'])) {
    $zoekterm = $_GET['zoekterm'];

    $sql = "SELECT * FROM werkzaamheden WHERE ID LIKE '%$zoekterm%' OR Voornaam LIKE '%$zoekterm%' OR Tussenvoegsel LIKE '%$zoekterm%' OR Achternaam LIKE '%$zoekterm%' OR Aantal_Uren LIKE '%$zoekterm%' OR Project_Naam LIKE '%$zoekterm%' OR Omschrijving_Werkzaamheden  LIKE '%$zoekterm%'";
    $result = mysqli_query($conn, $sql);
   
} else {

    // Query om gegevens op te halen
    $sql = "SELECT ID, Voornaam, Tussenvoegsel, Achternaam, Aantal_Uren, Project_Naam, Omschrijving_Werkzaamheden FROM werkzaamheden";
    $result = mysqli_query($conn, $sql);
}
if(mysqli_num_rows($result) > 0){
    // Tabel met gegevens tonen
    echo "<table id='table'>";
    echo "<tr><th>ID</th><th>Voornaam</th><th>Achternaam</th><th>Uren</th><th>Project</th><th>Werkzaamheden</th></tr>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr><td>" . $row["ID"] . "</td><td>" . $row["Voornaam"] . "</td><td>" . $row["Achternaam"] . "</td><td>" . $row["Aantal_Uren"] . "</td><td>" . $row["Project_Naam"] . "</td><td>" . $row["Omschrijving_Werkzaamheden"] . "</td></tr>";
    }
    echo "</table>";
}else {
    echo"Geen resultsten gevonden.";
}
    // Verbinding met database verbreken
    mysqli_close($conn);

    ?>
