<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "us3/4";
$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Functie om een factuur per e-mail te verzenden
function sendInvoiceByEmail($invoiceData, $email) {
    // Factuur genereren
    $invoiceHtml = generateInvoice($invoiceData);

    // Factuur opslaan als HTML-bestand
    $filename = 'factuur_'.$invoiceData['factuurnummer'].'.html';
    file_put_contents($filename, $invoiceHtml);

    // E-mail verzenden met factuur als bijlage
    $subject = 'Factuur';
    $message = 'Beste klant, zie de bijgevoegde factuur.';
    $headers = "From: nnrbrhm@gmail.com\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
    $headers .= "Content-Disposition: attachment; filename=\"{$filename}\"\r\n";

    // SMTP-configuratie
    $smtpHost = 'smtp.gmail.com';
    $smtpPort = 587;
    $smtpUsername = 'nnrbrhm@gmail.com';
    $smtpPassword = 'Roermond2019';

// Verbind met de SMTP-server
$smtpConnect = fsockopen($smtpHost, $smtpPort, $errno, $errstr, 10);
if (!$smtpConnect) {
    echo "Er is een probleem opgetreden bij het verbinden met de SMTP-server.";
    return;
}

// Lees het welkomstbericht van de SMTP-server
$smtpResponse = fgets($smtpConnect, 515);
if (substr($smtpResponse, 0, 3) != '220') {
    echo "Er is een probleem opgetreden bij het verbinden met de SMTP-server.";
    return;
}

// Controleer of de OpenSSL-extensie is ingeschakeld
if (extension_loaded('openssl')) {
    // STARTTLS-commando uitvoeren
    fputs($smtpConnect, "STARTTLS\r\n");
    $smtpResponse = fgets($smtpConnect, 515);
    if (substr($smtpResponse, 0, 3) != '220') {
        echo "STARTTLS kan niet worden gestart.";
        return;
    }

    // TLS-encryptie instellen
    if (!stream_socket_enable_crypto($smtpConnect, true, STREAM_CRYPTO_METHOD_TLS_CLIENT)) {
        echo "TLS-encryptie kan niet worden ingesteld.";
        return;
    }
} else {
    echo "De OpenSSL-extensie is niet ingeschakeld. STARTTLS kan niet worden uitgevoerd.";
    return;
}


// SMTP-authenticatie uitvoeren
fputs($smtpConnect, "EHLO localhost\r\n");
fputs($smtpConnect, "AUTH LOGIN\r\n");
fputs($smtpConnect, base64_encode($smtpUsername)."\r\n");
fputs($smtpConnect, base64_encode($smtpPassword)."\r\n");

    // E-mail verzenden
    fputs($smtpConnect, "MAIL FROM: <$smtpUsername>\r\n");
    fputs($smtpConnect, "RCPT TO: <$email>\r\n");
    fputs($smtpConnect, "DATA\r\n");
    fputs($smtpConnect, "Subject: $subject\r\n");
    fputs($smtpConnect, "To: $email\r\n");
    fputs($smtpConnect, $headers."\r\n");
    fputs($smtpConnect, "$message\r\n");
    fputs($smtpConnect, ".\r\n"); // Sluit de e-mailaflevering af met een enkele punt
    fputs($smtpConnect, "QUIT\r\n");

    // Controleer of de e-mail succesvol is verzonden
    $smtpResponse = fgets($smtpConnect, 515);
    if (substr($smtpResponse, 0, 3) != '250') {
        echo "Er is een probleem opgetreden bij het verzenden van de e-mail.";
        return;
    }

    // Sluit de verbinding met de SMTP-server
    fclose($smtpConnect);

    // Verwijder het tijdelijke HTML-bestand van de factuur
    unlink($filename);

    echo "De factuur is succesvol verzonden naar $email.";
}

if (isset($_GET['zoekterm'])) {
    $zoekterm = $_GET['zoekterm'];

    $sql = "SELECT * FROM klanten WHERE ID LIKE '%$zoekterm%' OR bedrijfsnaam LIKE '%$zoekterm%' OR voornaam LIKE '%$zoekterm%' OR tussenvoegsel LIKE '%$zoekterm%' OR achternaam LIKE '%$zoekterm%' OR functie LIKE '%$zoekterm%' OR email LIKE '%$zoekterm%' OR telefoonnummer LIKE '%$zoekterm%' OR adres LIKE '%$zoekterm%'";
    $result = mysqli_query($conn, $sql);
} else {
    // anders haal alle klanten op
    $sql = "SELECT ID, bedrijfsnaam, voornaam, tussenvoegsel, achternaam, functie, email, telefoonnummer, adres FROM klanten";
    $result = mysqli_query($conn, $sql);
}

if (mysqli_num_rows($result) > 0) {
    echo "<table>";
    echo "<tr><th>ID</th><th>Bedrijfsnaam</th><th>Voornaam</th><th>Tussenvoegsel</th><th>Achternaam</th><th>Functie</th><th>Email</th><th>Telefoonnummer</th><th>Adres</th></tr>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr><td>".$row['ID']."</td><td>".$row['bedrijfsnaam']."</td><td>".$row['voornaam']."</td><td>".$row['tussenvoegsel']."</td><td>".$row['achternaam']."</td><td>".$row['functie']."</td><td>".$row['email']."</td><td>".$row['telefoonnummer']."</td><td>".$row['adres']."</td></tr>";
        
        // Factuurgegevens
        $invoiceData = array(
            'factuurnummer' => $row['ID'],  // Gebruik een geschikte kolom voor het factuurnummer uit je database
            // Voeg andere relevante factuurgegevens toe
        );

        // E-mail verzenden met factuur naar de klant
        $email = $row['email'];  // Gebruik een geschikte kolom voor het e-mailadres uit je database
        sendInvoiceByEmail($invoiceData, $email);
    }
    echo "</table>";
} else {
   
    echo "Geen resultaten gevonden.";
}

mysqli_close($conn);

// Functie om een factuur te genereren
function generateInvoice($invoiceData) {
    // Implementeer hier de logica om de factuur te genereren op basis van de $invoiceData
    // Je kunt bijvoorbeeld HTML-sjablonen gebruiken en de gegevens invullen met behulp van variabelen
    // Retourneer de gegenereerde factuur als een string (HTML)
}
  // Voorbeeld van een factuur HTML-sjabloon
  $html = '
  <html>
  <head>
      <style>
          /* Voeg hier je CSS-stijlen toe voor de factuur */
      </style>
  </head>
  <body>
      <h1>Factuur</h1>
      <table>
          <tr>
              <th>Factuurnummer</th>
              <td>' . $invoiceData['factuurnummer'] . '</td>
          </tr>
          <tr>
              <th>Klantnaam</th>
              <td>' . $invoiceData['Klantnaam'] . '</td>
          </tr>
          <!-- Voeg hier andere factuurgegevens toe -->
      </table>
  </body>
  </html>';

// Retourneer de gegenereerde factuur als een string (HTML)
return 
$html; 
    
?>