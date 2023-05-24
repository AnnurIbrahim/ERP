<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" href="style.css">
  <title>Document</title>
</head>
<body>
<div class=topbar1>
        <a href="Home.php">Home</a>
        <a href="Werkzaamheden.php">Werkzaamheden</a>
        <a href="Klanten.php">Klanten</a>
        <a href="Opdrachten.php">Opdrachten</a>
        <a href="Rooster.php">Rooster</a>
        <a href="Medewerkers.php">Medewerkers</a>
		<a href="Acceptatietest.php">Acceptatietest</a>
        <a href="javascript:void(0);" class="icon" onclick="myFunction()">&#9776;</a>
        <!--Links menu voor zoekpagina-->
        <form action="Opdrachten.php" method="GET">
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
<?php
// Set the database credentials
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname= "us3/4";

        $conn = mysqli_connect($servername, $username, $password, $dbname);

        // deze code om verbinding te maken met databases. Als de verbinding van de databases mislukt, dan krijgt de gebruiker een duidelijk 
        //melding met daarin connection failed d  oor de die() element //
        if (!$conn) {
          die("Connection failed: " . mysqli_connect_error());
        }

        //echo "😁😋😊😊😋";//
        /* en ook om specifieke klommen te selecteren uit databases van Opdrachten */
        if(isset($_GET['zoekterm'])) {
            $zoekterm = $_GET['zoekterm'];
        
            $sql = "SELECT * FROM Opdrachten WHERE ID LIKE '%$zoekterm%' OR Klantnaam LIKE '%$zoekterm%' OR Titel LIKE '%$zoekterm%' OR Omschrijving  LIKE '%$zoekterm%' OR Aanvraagdatum LIKE '%$zoekterm%' OR Kennis LIKE'%$zoekterm%' ";
            $result = mysqli_query($conn, $sql);
           
        } else {
        $sql = "SELECT ID, Klantnaam, Titel, Omschrijving, Aanvraagdatum, Kennis  FROM Opdrachten";

        $result = mysqli_query($conn, $sql);
        }
        if(mysqli_num_rows($result) > 0) {
        echo "<table id='table1'>";
            // output table headers van html
            echo "<tr><th>ID</th><th>Klantnaam</th><th>Title</th><th>Omschrijving</th><th>Aanvraagdatum</th><th>Kennis</th></tr>";

            // output data om elke klommen gegevens uit te halen
           while($row = $result->fetch_assoc()){

                // output van de table klommen
                echo "<tr><td>" . $row["ID"]. "</td><td>" . $row["Klantnaam"]. "</td><td>" . $row["Titel"].
                "</td><td>".$row["Omschrijving"]."</td><td>".$row["Aanvraagdatum"]."</td><td>".$row["Kennis"]; 
            }
        
            // end table
            echo "</table>";
        }else {
            echo "Geen resultaten gevonden.";
        }
            mysqli_close($conn);
?>
</body>
</html>