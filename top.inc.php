<!DOCTYPE html>
<html>
<head>
  <title><?php global $title; print $title; ?></title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<img src="gilde-opleidingen.jpg" width="400" height="130"> 
<div class=topbar2>
<a href="Loguit.php">Loguit</a>
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
