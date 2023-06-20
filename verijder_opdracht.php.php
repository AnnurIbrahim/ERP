<?php
session_start();

// Controleer of de gebruiker is ingelogd
if (!isset($_SESSION['Voornaam'])) {
    header('Location: Login.php');
    exit;
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
    } else {
        // ...

        // Verstuur een foutmelding naar JavaScript
        echo "error";
    }
}

// ...
?>

<!-- Voeg de JavaScript-code toe aan je HTML-pagina -->
<script>
function verwijderOpdracht(opdrachtId) {
  if (confirm("Weet je zeker dat je deze opdracht wilt verwijderen?")) {
    // Maak een AJAX-verzoek naar de PHP-pagina om de opdracht te verwijderen
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState === 4 && this.status === 200) {
        if (this.responseText === "success") {
          // Opdracht succesvol verwijderd, voer hier de gewenste actie uit (bijv. vernieuw de opdrachtenlijst)
          window.location.reload();
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