<?php
session_start();

// Controleer of de gebruiker is ingelogd
if (!isset($_SESSION['Werkmail'])) {
    header('Location: Login.php');
    exit;
}
?>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "us3/4";
$conn = new mysqli($servername, $username, $password, $dbname);

// Controleer de verbinding
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// ...

// Controleer of de opdracht-ID is meegegeven in de URL
if (isset($_GET['id'])) {
    $opdrachtId = $_GET['id'];

    // ...

    // Verwijder de opdracht uit de database
    $sql = "DELETE FROM Opdrachten WHERE ID = $opdrachtId";
    if ($conn->query($sql) === TRUE) {
        // ...

        // Verstuur een succesmelding naar JavaScript
        echo "success";
        // Als de opdracht verijderd is, stuur de gebruiker terug naar opdrachten.php
        header('Location: opdrachten.php');
        exit;
    } else {
        // ...

        // Verstuur een foutmelding naar JavaScript
        echo "error";
    }
}

?>

<!-- Voeg de JavaScript-code toe aan je HTML-pagina -->
<script>
function verwijderOpdracht(opdrachtId) {
    if (confirm("Weet je zeker dat je deze opdracht wilt verwijderen?")) {
        // Dit is een AJAX-verzoek naar de PHP-pagina om de opdracht te verwijderen
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState === 4 && this.status === 200) {
                if (this.responseText === "success") {
                    // Opdracht succesvol verwijderd, pagina wordt automatisch vernieuwd en gebruiker wordt teruggestuurd naar opdrachten.php
                } else {
                    // Fout bij het verwijderen van de opdracht, toon een foutmelding aan de gebruiker
                    alert("Fout bij het verwijderen van de opdracht.");
                }
            }
        };
        xmlhttp.open("GET", "verwijderopdracht.php?id=" + opdrachtId, true);
        xmlhttp.send();
    }
}
</script>