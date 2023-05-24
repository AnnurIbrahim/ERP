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
        <!--Links menu voor zoekpagina-->
		<form action="Medewerkers.php" method="GET">
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
	// Database credentials
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "us3/4";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);

	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}

	if (isset($_GET['zoekterm'])) {
		$zoekterm = $_GET['zoekterm'];
		$sql = "SELECT * FROM medewerkers WHERE ID LIKE '%$zoekterm%' OR Voornaam LIKE '%$zoekterm%' OR Tussenvoegsel LIKE '%$zoekterm%' OR Achternaam LIKE '%$zoekterm%' OR Geboortedatum LIKE '%$zoekterm%' OR Functie LIKE '%$zoekterm%' OR Werkmail LIKE '%$zoekterm%' OR Kantoorruimte LIKE '%$zoekterm%'";
		$result = mysqli_query($conn, $sql);

		if ($result === false) {
			die("Query failed: " . mysqli_error($conn));
		}
	} else {
		// SQL query to retrieve data from the "medewerkers" table
		$sql = "SELECT ID, Voornaam, Tussenvoegsel, Achternaam, Geboortedatum, Functie, Werkmail, Kantoorruimte FROM medewerkers";
		$result = $conn->query($sql);

		if ($result === false) {
			die("Query failed: " . mysqli_error($conn));
		}
	}

	if (mysqli_num_rows($result) > 0) {
		// Output data in a table
		echo "<table>";
		echo "<tr><th>ID</th><th>Voornaam</th><th>Tussenvoegsel</th><th>Achternaam</th><th>Geboortedatum</th><th>Functie</th><th>Werkmail</th><th>Kantoorruimte</th></tr>";
		while ($row = $result->fetch_assoc()) {
			echo "<tr><td>".$row["ID"]."</td><td>".$row["Voornaam"]."</td><td>".$row["Tussenvoegsel"]."</td><td>".$row["Achternaam"]."</td><td>".$row["Geboortedatum"]."</td><td>".$row["Functie"]."</td><td>".$row["Werkmail"]."</td><td>".$row["Kantoorruimte"]."</td></tr>";
		}
		echo "</table>";
	} else {
		echo "No results found";
	}
	mysqli_close ($conn);
?>

