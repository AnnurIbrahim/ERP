<?php
session_start();

// Controleer of de gebruiker is ingelogd
if (!isset($_SESSION['Voornaam'])) {
    header('Location: Login.php');
    exit;
}
?>
<html lang="en">
<head>
  <link rel="stylesheet" href="style.css">
  <title>Medewerker</title>
</head>
<body>
<div class=topbar>
            <a href="Home.php">Home</a>
            <a href="Werkzaamheden.php">Werkzaamheden</a>
            <a href="uren_registeren.php">Uren Registreren</a>
            <a href="Klanten.php">Klanten</a>
            <a href="Opdrachten.php">Opdrachten</a>
            <a href="Rooster.php">Rooster</a>
            <a href="Medewerkers.php">Medewerkers</a>
            <a href="Acceptatietest.php">Acceptatietest</a>
            <a href="javascript:void(0);" class="icon" onclick="myFunction()">&#9776;</a>
            <!--Links menu voor zoekpagina-->
            <form action="Rooster.php" method="GET">
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
        if (isset($_SESSION["voornaam"])) {
           // echo "Ingelogde gebruiker: " . $_SESSION["username"];//
        }
        ?>
        <?php
        // Connecten met de database. Inloggegevens.
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname= "us3/4"; //naam van database
        $tabel= "";
        $conn = mysqli_connect($servername, $username, $password, $dbname);

        // Er komt "Connection Failed" te staan als het mislukt met connecten.
        if (!$conn) {
          die("Connection failed: " . mysqli_connect_error());
        }
        if(isset($_GET['zoekterm'])) {
            $zoekterm = $_GET['zoekterm'];
        
            $sql = "SELECT * FROM Rooster WHERE ID LIKE '%$zoekterm%' OR MedewerkerID LIKE '%$zoekterm%' OR Maandag LIKE '%$zoekterm%' OR Dinsdag LIKE '%$zoekterm%' OR Woensdag LIKE '%$zoekterm%' OR Donderdag LIKE '%$zoekterm%' OR Vrijdag LIKE '%$zoekterm%' OR Zaterdag LIKE '%$zoekterm%' OR Zondag LIKE '%$zoekterm%'";
            $result = mysqli_query($conn, $sql);
           
        } else {
        /* Selecteert de kolommen van de database. ID etc. */
        $sql = "SELECT ID, MedewerkerID, maandag, dinsdag, woensdag, donderdag, vrijdag, zaterdag, zondag FROM Rooster";
        $result = mysqli_query($conn, $sql);
        }
        if(mysqli_num_rows($result) > 0) {
        echo "<table>";
             // Output van table headers. Het ziet er beter uit zo.
        echo "<tr><th>ID</th><th>MedewerkerID</th><th>maandag</th><th>dinsdag</th><th>woensdag</th><th>donderdag</th><th>Vrijdag</th><th>zaterdag</th><th>zondag</th></tr>";

            // Fetched/Pakt gegevens van de kolommen
           while($row = $result->fetch_assoc()){
                // Output van de tabellen
                echo "<tr><td>" . $row["ID"]. "</td><td>" . $row["MedewerkerID"].
                "</td><td>".$row["maandag"]."</td><td>".$row["dinsdag"]."</td><td>".$row["woensdag"]."</td><td>".$row["donderdag"].
                "</td><td>".$row["vrijdag"]."</td><td>".$row["zaterdag"]."</td><td>".$row["zondag"]; 
            }
            // Einde tabel
            echo"</table>";
        }else {
            echo "geen resultaten gevonden.";//Als er niks wordt gevonden krijg je "0 results" te zien
        }
            mysqli_close($conn);
    ?>
