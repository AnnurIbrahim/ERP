<?php
require_once "database.php";
global $title;
$title="Rooster";
include_once "top.inc.php";

connect();
$result=laadOpdrachten();
toonOpdrachten($result);
disconnect();

include_once "bottom.inc.php";
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
            <a href="Klanten.php">Klanten</a>
            <a href="Opdrachten.php">Opdrachten</a>
            <a href="Rooster.php">Rooster</a>
            <a href="Medewerkers.php">Medewerkers</a>
            <a href="Acceptatietest.php">Acceptatietest</a>
            <a href="javascript:void(0);" class="icon" onclick="myFunction()">&#9776;</a>
           
      
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
        
            $sql = "SELECT * FROM Rooster WHERE ID LIKE '%$zoekterm%' OR Voornaam LIKE '%$zoekterm%' OR Achternaam LIKE '%$zoekterm%' OR Maandag LIKE '%$zoekterm%' OR DinsdagLIKE '%$zoekterm%' OR Woensdag LIKE '%$zoekterm%' OR Donderdag LIKE '%$zoekterm%' OR Vrijdag LIKE '%$zoekterm%' OR Zaterdag LIKE '%$zoekterm%' OR Zondag LIKE '%$zoekterm%'";
            $result = mysqli_query($conn, $sql);
           
        } else {
        /* Selecteert de kolommen van de database. ID etc. */
        $sql = "SELECT ID, voornaam, achternaam, maandag, dinsdag, woensdag, donderdag, donderdag, vrijdag, zaterdag, zondag FROM Rooster";
        $result = mysqli_query($conn, $sql);
        }
        if(mysqli_num_rows($result) > 0) {
        echo "<table>";
             // Output van table headers. Het ziet er beter uit zo.
        echo "<tr><th>ID</th><th>voornaam</th><th>achternaam</th><th>maandag</th><th>dinsdag</th><th>woensdag</th><th>donderdag</th><th>Vrijdag</th><th>zaterdag</th><th>zondag</th></tr>";

            // Fetched/Pakt gegevens van de kolommen
           while($row = $result->fetch_assoc()){
                // Output van de tabellen
                echo "<tr><td>" . $row["ID"]. "</td><td>" . $row["voornaam"]. "</td><td>" . $row["achternaam"].
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

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="Style.css">
        <title>Document</title>
    </head>
    <body>
        <h1>Rooster</h1>
        <?php echo $tabel;?>
    </body>
</html>