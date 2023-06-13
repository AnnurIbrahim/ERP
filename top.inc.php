<!DOCTYPE html>
<html>
<head>
  <title><?php global $title; print $title; ?></title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<style>
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
<body>
<img src="gilde-opleidingen.jpg" width="400" height="130"> 
<div class=topbar2>
  <a href="Loguit.php" class="logout-btn"><i class="fas fa-sign-out-alt"></i> Loguit</a>
  <a href="Home.php">Home</a>
  <a href="Werkzaamheden.php">Werkzaamheden</a>
  <a href= "uren_registeren.php">Uren Registreren</a>
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
