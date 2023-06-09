<?php
session_start();

// Controleer of de gebruiker is ingelogd
if (!isset($_SESSION['Werkmail'])) {
    header('Location: Login.php');
    exit;
}
?> 
<!DOCTYPE html>
<html>
<head>
	<title>Welkom!</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-xxxxx" crossorigin="anonymous" />
	<style>
	body {
		background: transparent;
	}
	
	#myVideo {
		position: fixed;
		right: 0;
		bottom: 0;
		min-width: 100%; 
		min-height: 100%;
		z-index: -1;
		background-size: cover;
	}
	.Welkom P{
		text-align: center;
		margin-top: -45px;
	}
	.Welkom img {
		margin-top: -11px;
	}

	.logout-btn {
		background-color: #ff0000;
		color: #fff;
		padding: 10px 20px;
		border-radius: 5px;
		text-decoration: none;
		font-weight: bold;
	}

	.logout-btn i {
		margin-right: 5px;
	}

	.logout-btn:hover {
		background-color: #cc0000;
	}
	</style>
</style>
</head>
<body>
<video autoplay muted loop id="myVideo">	
  <source src="Video2.mp4" type="video/mp4"></video>
  <div class="Welkom">
  <img src="gilde-opleidingen.jpg" width="200" height="60">
  <p> 
                Welcome
                <strong>
                    <?php echo $_SESSION['Voornaam']; ?>
                </strong>
            </p>
</div>
  <div class=topbar2>
  			<a href="Loguit.php" class="logout-btn"><i class="fas fa-sign-out-alt"></i> Loguit</a>
            <a href="Home.php">Home</a>
            <a href="Werkzaamheden.php">Werkzaamheden</a>
			<a href= "uren_registeren.php">Uren Invullen</a>
            <a href="Klanten.php">Klanten</a>
            <a href="Opdrachten.php">Opdrachten</a>
            <a href="Rooster.php">Rooster</a>
            <a href="Medewerkers.php">Medewerkers</a>
            <a href="Acceptatietest.php">Acceptatietest</a>
            <a href="javascript:void(0);" class="icon" onclick="myFunction()">&#9776;</a>
            
        </div>
	<script>
	function myFunction() {
		var x = document.getElementsByClassName("topbar2")[0];
		if (x.className === "topbar2") {
			x.className += " responsive";
		} else {
			x.className = "topbar2";
		}
	}
	</script>
	<h1>Welkom op onze website!</h1>
	<?php
		// PHP code om de huidige tijd te verkrijgen
		date_default_timezone_set("Europe/Amsterdam");
		$current_time = date("H:i:s");
		
		// HTML code om de tijd op de pagina te tonen
		echo "<p>De huidige tijd is: $current_time</p>";
	?>
</body>
</html>
