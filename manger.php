<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Manager</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <h1>Rooster - Managerinterface</h1>

  <form action="" method="GET">
    <label for="search">MedewerkerID:</label>
    <input type="text" id="search" name="search">
    <button type="submit">Zoeken</button>
  </form>

  <?php
  if (isset($_GET['search'])) {
    $searchTerm = $_GET['search'];

    // Voer hier de logica uit om de medewerkerinformatie op te halen en in te plannen op basis van het MedewerkerID
    // Implementeer de benodigde PHP-code om de medewerkergegevens en inplaninformatie weer te geven
    // Je kunt de gegevens weergeven in een tabel of een andere geschikte opmaak

    echo "<h2>Resultaten voor MedewerkerID: $searchTerm</h2>";
    // Toon hier de geplande roostergegevens voor de gevonden medewerker
  }
  ?>

  <table>
    <tr>
      <th>ID</th>
      <th>MedewerkerID</th>
      <th>Maandag</th>
      <th>Dinsdag</th>
      <th>Woensdag</th>
      <th>Donderdag</th>
      <th>Vrijdag</th>
      <th>Zaterdag</th>
      <th>Zondag</th>
      <th></th> <!-- Bewerk knoppenkolom -->
    </tr>
    <tr>
      <td>1</td>
      <td>1001</td>
      <td><input type="text" value="Shift 1"></td>
      <td><input type="text" value="Shift 2"></td>
      <td><input type="text" value="Shift 1"></td>
      <td><input type="text" value="Shift 3"></td>
      <td><input type="text" value="Shift 2"></td>
      <td><input type="text" value="Vrij"></td>
      <td><input type="text" value="Vrij"></td>
      <td>
        <button class="edit-button">Bewerk</button>
        <button class="save-button">Opslaan</button>
      </td>
    </tr>
    <!-- Voeg hier de andere rijen met gegevens toe -->
  </table>

  <script src="script.js"></script>
</body>
</html>
