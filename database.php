<?php
if (!defined('NO_VALIDATE')){
  session_start();
  // Controleer of de gebruiker is ingelogd
  if (!isset($_SESSION['Voornaam'])){
    header('Location: Login.php');
    exit;
  }
}

global $conn;
$conn=null;

function connect(){
  global $conn;
      $servername = "localhost";
      $username = "root";
      $password = "";
      $dbname = "us3/4";
      $port = 3306;

  $conn=mysqli_connect($servername,$username,$password,$dbname,$port);

  if (!$conn){
    die("Connection failed: ".mysqli_connect_error());
  }
  return $conn;
}

function disconnect(){
  global $conn;
  mysqli_close($conn);
}

/**
 * @return bool|\mysqli_result
 */
function zoekKlanten(){
  global $conn;

  // Als er een zoekterm is ingevuld
  if (isset($_GET['zoekterm'])){
    $zoekterm=$_GET['zoekterm'];
    $sql   ="SELECT * FROM klanten WHERE ID LIKE '%$zoekterm%' OR bedrijfsnaam LIKE '%$zoekterm%' OR voornaam LIKE '%$zoekterm%' OR tussenvoegsel LIKE '%$zoekterm%' OR achternaam LIKE '%$zoekterm%' OR functie LIKE '%$zoekterm%' OR email LIKE '%$zoekterm%' OR telefoonnummer LIKE '%$zoekterm%' OR adres LIKE '%$zoekterm%'";
  } else{
    // Anders haal alle klanten op
    $sql   ="SELECT ID, bedrijfsnaam, voornaam, tussenvoegsel, achternaam, functie, email, telefoonnummer, adres FROM klanten";
  }
  return mysqli_query($conn,$sql);
}
/**
 * @return bool|\mysqli_result
 */
function zoekOpdrachten(){
  global $conn;

  // Als er een zoekterm is ingevuld
  if (isset($_GET['zoekterm'])){
    $zoekterm=$_GET['zoekterm'];
    $sql = "SELECT * FROM Opdrachten WHERE ID LIKE '%$zoekterm%' OR Klantnaam LIKE '%$zoekterm%' OR Titel LIKE '%$zoekterm%' OR Omschrijving  LIKE '%$zoekterm%' OR Aanvraagdatum LIKE '%$zoekterm%' OR Kennis LIKE'%$zoekterm%' ";
  } else{
    // Anders haal alle klanten op
    $sql = "SELECT ID, Klantnaam, Titel, Omschrijving, Aanvraagdatum, Kennis  FROM Opdrachten";
  }
  return mysqli_query($conn,$sql);
}
/**
 * @return bool|\mysqli_result
 */
function zoekWerkzaamheden(){
  global $conn;

  // Als er een zoekterm is ingevuld
  if (isset($_GET['zoekterm'])){
    $zoekterm=$_GET['zoekterm'];
    $sql = "SELECT * FROM werkzaamheden WHERE ID LIKE '%$zoekterm%' OR MedewerkerID  LIKE '%$zoekterm%' OR `OpdrachtenID` LIKE '%$zoekterm%' OR Aantal_Uren LIKE '%$zoekterm%' OR Project_Naam LIKE '%$zoekterm%' OR Omschrijving_Werkzaamheden  LIKE '%$zoekterm%'";
  } else{
    // Anders haal alle klanten op
    $sql = "SELECT ID, MedewerkerID, `OpdrachtenID`, Aantal_Uren, Project_Naam, Omschrijving_Werkzaamheden FROM werkzaamheden";
  }
  return mysqli_query($conn,$sql);
}
/**
 * @return bool|\mysqli_result
 */
function zoekMedewerkers(){
  global $conn;
  if (isset($_GET['zoekterm'])){
    $zoekterm=$_GET['zoekterm'];
    $sql     ="SELECT * FROM medewerkers WHERE ID LIKE '%$zoekterm%' OR Voornaam LIKE '%$zoekterm%' OR Tussenvoegsel LIKE '%$zoekterm%' OR Achternaam LIKE '%$zoekterm%' OR Geboortedatum LIKE '%$zoekterm%' OR functie LIKE '%$zoekterm%' OR Werkmail LIKE '%$zoekterm%' OR Kantoorruimte LIKE '%$zoekterm%'";
  } else{
    // SQL query to retrieve data from the "medewerkers" table
    $sql  ="SELECT ID, Voornaam, Tussenvoegsel, Achternaam, Geboortedatum, Functie, Werkmail, Kantoorruimte FROM medewerkers";
  }
  return mysqli_query($conn,$sql);
}

/**
 * @return bool|\mysqli_result
 */
function zoekAcceptatietesten(){
  global $conn;
  if (isset($_GET['zoekterm'])){
    $zoekterm=$_GET['zoekterm'];
    $sql     ="SELECT * FROM acceptatietesten WHERE TestId LIKE '%$zoekterm%' OR US LIKE '%$zoekterm%' OR functionaliteit LIKE '%$zoekterm%' OR gewenst_resultaat LIKE '%$zoekterm%' OR werkelijk_resultaat LIKE '%$zoekterm%' OR success LIKE '%$zoekterm%'";
  } else{
    // SQL query to retrieve data from the "medewerkers" table
    $sql   ="SELECT TestId, US, functionaliteit, gewenst_resultaat, werkelijk_resultaat, success, datum FROM acceptatietesten";
  }
  return mysqli_query($conn,$sql);
}

/**
 * @return bool|\mysqli_result
 */
function zoekRooster(){
  global $conn;
  if (isset($_GET['zoekterm'])){
    $zoekterm=$_GET['zoekterm'];
    $sql     ="SELECT * FROM rooster WHERE ID LIKE '%$zoekterm%' OR MedewerkerID LIKE '%$zoekterm%' OR maandag LIKE '%$zoekterm%' OR dinsdag LIKE '%$zoekterm%' OR woensdag LIKE '%$zoekterm%' OR donderdag LIKE '%$zoekterm%' OR vrijdag LIKE '%$zoekterm%' OR zaterdag LIKE '%$zoekterm%' OR zondag ";
  } else{
    // SQL query to retrieve data from the "medewerkers" table
    $sql   ="SELECT ID, MedewerkerID, maandag, dinsdag, woensdag, donderdag, vrijdag, zaterdag, zondag FROM Rooster";
  }
  //return mysqli_query($conn,$sql);
  $result=mysqli_query($conn,$sql);
  if ($result===false) {die ($mysqli_error($conn));}
  return $result;
}
/**
 * @return bool|\mysqli_result
 */
function laadOpdrachten(){
  global $conn;
  // SQL query to retrieve data from the "medewerkers" table
  $sql   ="SELECT ID, Klantnaam, Titel, Omschrijving, Aanvraagdatum, Kennis  FROM Opdrachten";
  $result=mysqli_query($conn,$sql);
  return $result;
}

/**
 * @return bool|\mysqli_result
 */
function laadWerkzaamheden(){
  global $conn;
  // SQL query to retrieve data from the "werkzaamheden" table
  $sql   ="SELECT ID, MedewerkerID, OpdrachtenID, Aantal_Uren, Project_Naam, Omschrijving_Werkzaamheden FROM werkzaamheden";
  $result=mysqli_query($conn,$sql);
  return $result;
}

/**
 * @return bool|\mysqli_result
 */
function laadAcceptatietesten(){
  global $conn;
  // SQL query to retrieve data from the "werkzaamheden" table
  $sql   ="SELECT TestId, US, functionaliteit, gewenst_resultaat, werkelijk_resultaat, success, datum FROM acceptatietesten";
  $result=mysqli_query($conn,$sql);
  return $result;
}

/**
 * @return bool|\mysqli_result
 */
function laadRooster(){
  global $conn;
  // SQL query to retrieve data from the "werkzaamheden" table
  $sql   ="SELECT ID, MedewerkerID, maandag, dinsdag, woensdag, donderdag, vrijdag, zaterdag, zondag FROM Rooster";
  $result=mysqli_query($conn,$sql);
  return $result;
}

/**
 * @param \mysqli_result $result
 *
 * @return void
 */
function toonKlanten(mysqli_result $result){
  if (mysqli_num_rows($result)>0){
    echo '<div class="button-container">';
    echo '<a href="klantgevens.php" class="button">Gegevens Bewerken</a>';
    echo '</div>';
    echo '<div class="button-container1">';
    echo '<a href="Nieuw-klant.php" class="button">Nieuw klant toevoegen</a>';
    echo '</div>';
    echo "<table>";
    echo "<tr><th>ID</th><th>Bedrijfsnaam</th><th>Voornaam</th><th>Tussenvoegsel</th><th>Achternaam</th><th>Functie</th><th>Email</th><th>Telefoonnummer</th><th>Adres</th></tr>";
    while($row=mysqli_fetch_assoc($result)){
      echo "<tr><td>".$row['ID']."</td><td>".$row['bedrijfsnaam']."</td><td>".$row['voornaam']."</td><td>".$row['tussenvoegsel']."</td><td>".$row['achternaam']."</td><td>".$row['functie']."</td><td>".$row['email']."</td><td>".$row['telefoonnummer']."</td><td>".$row['adres']."</td></tr>";
    }
    echo "</table>";
  } else{
    echo "Geen resultaten gevonden.";
  }
}

/**
 * @param \mysqli_result $result
 *
 * @return void
 */
function toonRooster(mysqli_result $result){
  if (mysqli_num_rows($result)>0){
    echo "<table>";
    echo "<tr><th>ID</th><th>MedewerkerID</th><th>maandag</th><th>dinsdag</th><th>woensdag</th><th>donderdag</th><th>Vrijdag</th><th>zaterdag</th><th>zondag</th></tr>";
    while($row=$result->fetch_assoc()){
      echo "<tr><td>".$row["ID"]."</td><td>".$row["MedewerkerID"].
           "</td><td>".$row["maandag"]."</td><td>".$row["dinsdag"]."</td><td>".$row["woensdag"]."</td><td>".$row["donderdag"].
           "</td><td>".$row["vrijdag"]."</td><td>".$row["zaterdag"]."</td><td>".$row["zondag"];
    }
    echo "</table>";
  } else{
    echo "Geen resultaten gevonden.";
  }
}

/**
 * @param \mysqli_result $result
 *
 * @return void
 */
function toonMedewerkers(mysqli_result $result){
  if ($result->num_rows>0){
    // Output data in a table
    echo "<table><tr><th>ID</th><th>Voornaam</th><th>Tussenvoegsel</th><th>Achternaam</th><th>Geboortedatum</th><th>Functie</th><th>Werkmail</th><th>Kantoorruimte</th></tr>";
    while($row=$result->fetch_assoc()){
      echo "<tr><td>".$row["ID"]."</td><td>".$row["Voornaam"]."</td><td>".$row["Tussenvoegsel"]."</td><td>".$row["Achternaam"]."</td><td>".$row["Geboortedatum"]."</td><td>".$row["Functie"]."</td><td>".$row["Werkmail"]."</td><td>".$row["Kantoorruimte"]."</td></tr>";
    }
    echo "</table>";
  } else{
    echo "No results found";
  }
}

function toonOpdrachten(mysqli_result $result){
  echo "<table id='table1'>";
  echo '<div class="button-container">';
    echo '<a href="opdrachten-toevoegen.php" class="button">Voeg opdracht </a>';
    echo '</div>';
  // output table headers van html
  echo "<tr><th>ID</th><th>Klantnaam</th><th>Title</th><th>Omschrijving</th><th>Aanvraagdatum</th><th>Kennis</th></tr>";
  // output data om elke klommen gegevens uit te halen
  while($row=$result->fetch_assoc()){
    // output van de table kl
    echo "<tr><td>".$row["ID"]."</td><td>".$row["Klantnaam"]."</td><td>".$row["Titel"].
         "</td><td>".$row["Omschrijving"]."</td><td>".$row["Aanvraagdatum"]."</td><td>".$row["Kennis"];
         echo "<td><a href='verijder_opdracht.php?id=" . $row['ID'] . "'><i class='fas fa-trash-alt'></i></a></td>";
  }
  // end table
  echo "</table>";
  // als er geen rijen gevonden zijn, betekent dit dat er geen overeenkomsten zijn met de databases.
  // In dat geval wordt de string "No results" geprint.
  if (mysqli_num_rows($result)==0){
    echo "No results";
  }
}

function toonWerkzaamheden(mysqli_result $result){
  // Tabel met gegevens tonen
  echo "<table id='table'>";
  echo "<tr><th>ID</th><th>MedewerkerID</th><th>OpdrachtenID</th><th>Uren</th><th>Project</th><th>Omschrijving</th></tr>";
  while($row=mysqli_fetch_assoc($result)){
    echo "<tr><td>".$row["ID"]."</td><td>".$row["MedewerkerID"]."</td><td>".$row["OpdrachtenID"]."</td><td>".$row["Aantal_Uren"]."</td><td>".$row["Project_Naam"]."</td><td>".$row["Omschrijving_Werkzaamheden"]."</td></tr>";
  }
  echo "</table>";
  // als er geen rijen gevonden zijn, betekent dit dat er geen overeenkomsten zijn met de databases.
  // In dat geval wordt de string "No results" geprint.
  if (mysqli_num_rows($result)==0){
    echo "No results";
  }
}

function toonAcceptatietesten(mysqli_result $result){
  // Tabel met gegevens tonen
  echo "<table id='table'>";
  echo "<tr><th>TestID</th><th>US</th><th>functionaliteit</th><th>Gewenst_resultaat</th><th>Werkelijk_resultaat</th><th>Success</th><th>Datum</th></tr>";
  while($row=mysqli_fetch_assoc($result)){
    echo "<tr><td>".$row["TestId"]."</td><td>".$row["US"]."</td><td>".$row["functionaliteit"]."</td><td>".$row["gewenst_resultaat"]."</td><td>".$row["werkelijk_resultaat"]."</td><td>".$row["success"]."</td><td>".$row["datum"]."</td></tr>";
  }
  echo "</table>";
  if (mysqli_num_rows($result)==0){
    echo "No results";
  }
}

?>  
