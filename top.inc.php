<!DOCTYPE html>
<html lang="EN-uk">

<head>
  <title><?php global $title;
    print $title; ?></title>
  <link rel="stylesheet" type="text/css" href="style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <style>
    .Welkom P {
      text-align:center;
      margin-top:-45px;
    }

    .Welkom img {
      margin-top:-11px;
    }
  </style>
</head>
<style>
  .logout-btn {
    background-color:#ff0000;
    color:#fff;
    padding:10px 20px;
    border-radius:5px;
    text-decoration:none;
    font-weight:bold;
  }

  .logout-btn i {
    margin-right:5px;
  }

  .logout-btn:hover {
    background-color:#cc0000;
  }
</style>

<body>
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
  <a href="uren_registeren.php">Uren Registreren</a>
  <a href="Klanten.php">Klanten</a>
  <a href="Opdrachten.php">Opdrachten</a>
  <a href="Rooster.php">Rooster</a>
  <a href="Medewerkers.php">Medewerkers</a>
  <a href="Acceptatietest.php">Acceptatietest</a>
  <a href="javascript:void(0);" class="icon" onclick="myFunction()">&#9776;</a>
  <!--Links menu voor zoekpagina-->
  <?php
  global $title;
  if (($title=="Klanten")||($title=="Medewerkers")||($title=="Acceptatietest")||($title=="Rooster")||($title=="Werkzaamheden")||($title=="Opdrachten")){
    echo "<form action=\"".$title.".php\" method=\"GET\">";
    echo "<label for=\"zoekterm\">Zoeken</label>";
    echo "<input type=\"text\" id=\"zoekterm\" name=\"zoekterm\" placeholder=\"Zoek ".$title."\">";
    echo "<button type=\"submit\">Zoeken</button>";
  }
  ?>
</div>
</body>
<script>
  function myFunction() {
    var x=document.getElementsByClassName("topbar2")[0];
    if (x.className==="topbar2") {
      x.className+=" responsive";
    } else {
      x.className="topbar2";
    }
  }
</script>
