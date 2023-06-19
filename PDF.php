<?php

require_once __DIR__ . '/vendor/autoload.php';

// Database connection configuration
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'us3/4';

// Create a new instance of mPDF
$mpdf = new \Mpdf\Mpdf();

// Set PDF formatting options
$mpdf->SetTitle('Facturia');
$mpdf->SetAuthor('Gilde DrumOps');

// Establish a database connection
$connection = new mysqli($servername, $username, $password, $dbname);

// Check if the connection was successful
if ($connection->connect_error) {
    die('Connection failed: ' . $connection->connect_error);
}

// Define the customer ID
$customerID = 2; // Replace with the actual customer ID

// SQL query with a WHERE clause to select a specific customer
$sql = "SELECT klanten.voornaam, klanten.email, klanten.adres, opdrachten.Aanvraagdatum, werkzaamheden.Omschrijving_Werkzaamheden
        FROM opdrachten
        INNER JOIN werkzaamheden ON werkzaamheden.OpdrachtenID = opdrachten.ID
        INNER JOIN klanten ON klanten.ID = opdrachten.KlantenID
        WHERE klanten.ID = $customerID";  

// Execute the query
$result = $connection->query($sql);

// Check if the query was successful
if ($result) {
    $html = '<!DOCTYPE html>
    <html lang="en">
      <head>
        <meta charset="utf-8">
        <title>Example</title>
        <link rel="stylesheet" href="pdf.css" media="all" />
      </head>
      <body>
        <header class="clearfix">
          <div id="logo">
            <img src="logo.jpg">
          </div>
          <h1>Factuurgegevens</h1>
          <div id="company" class="clearfix">
            <div>Gilde Opleidingen</div>
            <div>Bredeweg 235,<br /> 6042 GE, NL</div>
            <div>Nummer</div>
            <div><a href="mailto:johndoe@test.com">Gildeopleidingen@somalischecamera.de</a></div>
          </div>';

    while ($row = $result->fetch_assoc()) {
        $html .= '<div id="project">';
        $html .= '<div><span>PROJECT</span> Website development</div>';
        $html .= '<div><span>CLIENT</span> ' . $row['voornaam'] . '</div>';
        $html .= '<div><span>ADDRESS</span>' . $row['adres'] . '</div>';
        $html .= '<div><span>EMAIL</span> <a href="mailto:' . $row['email'] . '">' . $row['email'] . '</a></div>';
        $html .= '<div><span>DATE</span> ' . date('F j, Y') . '</div>';
        $html .= '<div><span>DUE DATE</span> ' . date('F j, Y', strtotime('+2 days')) . '</div>';
        $html .= '</div>';
    }

    $html .= '<main>
          <table>
            <thead>
              <tr>
                <th class="service">SERVICE</th>
                <th class="desc">DESCRIPTION</th>
                <th>PRICE</th>
                <th>QTY</th>
                <th>TOTAL</th>
              </tr>
            </thead>
            <tbody>';

    // Reset the query result pointer to the beginning
    $result->data_seek(0);

    while ($row = $result->fetch_assoc()) {
        $html .= '<tr>';
        $html .= '<td class="service">' . $row['voornaam'] . '</td>';
        $html .= '<td class="desc">' . $row['Omschrijving_Werkzaamheden'] . '</td>';
        $html .= '<td class="unit">$40.00</td>';
        $html .= '<td class="qty">26</td>';
        $html .= '<td class="total">$1,040.00</td>';
        $html .= '</tr>';
    }

    $html .= '</tbody>
          </table>
          <div id="notices">
            <div>NOTICE:</div>
            <div class="notice">Test</div>
          </div>
        </main>
        <footer>
          Test.
        </footer>
      </body>
    </html>';

    // Close the database connection
    $connection->close();

    // Output the PDF
    $mpdf->WriteHTML($html);
    $mpdf->Output('Factuur.pdf', 'D');
} else {
    echo 'Error executing the query: ' . $connection->error;
}

// Close the database connection
$connection->close();