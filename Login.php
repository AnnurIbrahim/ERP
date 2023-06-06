<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$servername = "localhost";
$dbusername = "root";
$dbpassword = "";   
$dbname = "us3/4";

session_start();

$data = mysqli_connect($servername, $dbusername, $dbpassword, $dbname);
if ($data === false) {
    die("Connection error");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Voornaam = $_POST["Voornaam"];
    $gebruikerid = $_POST["gebruikerid"];
    $sql = "SELECT Voornaam FROM medewerkers WHERE Voornaam = ? AND ID = ?";
    $stmt = mysqli_prepare($data, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $Voornaam, $gebruikerid);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result !== false && $result->num_rows == 1) {
        $row = mysqli_fetch_assoc($result);
        $voornaam = $row['Voornaam'];
        $_SESSION["Voornaam"] = $voornaam;
        header("Location: Home.php");
        exit();
    } else {
        echo '';
    }
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Login form</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            background-image: url("4882066.jpg");
            background-size: cover;
        }
        h1 {
            text-align: center;
            color:white;
        }
        .error-message {
            color: red;
            text-align: center;
        }
    </style>
</head>
<body>
    <center>
        <div>
            <h1>Uren Registratiesysteem</h1>
            <div class="container5">
                <div class=topbar5>
                    <h2>Inloggen</h2>
                    <?php
                    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($result) && $result->num_rows != 1) {
                        echo '<p class="error-message">Onjuist gebruikersnaam of wachtwoord</p>';
                    }
                    ?>
                    <form action="" method="post">
                        <input type="text" name="Voornaam" placeholder="Voornaam">
                        <input type="text" name="gebruikerid" placeholder="Gebruiker ID">
                        <input type="submit" value="Inloggen">
                    </form>
                    <a href="forgot_password.php">Wachtwoord vergeten?</a>
                </div>
            </div>
        </div>
    </center>
</body>
</html>