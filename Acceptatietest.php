<!DOCTYPE html>
<html>
<head>
    <title>Klanten</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
    <body>
    <img src="gilde-opleidingen.jpg" width="400" height="130"> 
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
            <form action="/search" method="get">
                <label for="search">Zoeken</label>
                <input type="text" id="search" name="q">
                <button type="submit">Zoeken</button>
            </form>
        </div>
    <?php
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

    // Query om gegevens op te halen
    $sql = "SELECT testid, us, functionaliteit, `gewenst resultaat`, `werkelijk resultaat`, success, datum FROM acceptatietesten";
    $result = mysqli_query($conn, $sql);

    // Tabel met gegevens tonen
        echo "<table id='table'>";
            echo "<tr><th>TestID</th><th>US</th><th>functionaliteit</th><th>Gewenst resultaat</th><th>Werkelijk resultaat</th><th>Success</th><th>Datum</th></tr>";
            while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr><td>" . $row["testid"] . "</td><td>" . $row["us"] . "</td><td>" . $row["functionaliteit"] . "</td><td>" . $row["gewenst resultaat"] . "</td><td>" . $row["werkelijk resultaat"] . "</td><td>" . $row["success"] . "</td><td>" . $row["datum"] . "</td></tr>";
        }
        echo "</table>";

        // Verbinding met database verbreken
        mysqli_close($conn);
    ?>