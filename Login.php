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

// Functie voor het genereren van een CSRF-token
function generate_csrf_token() {
    if (!isset($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

// Genereren van een CSRF-token bij elke paginaweergave
generate_csrf_token();

$timeout = 240; // 4 minuten (240 seconden)
if (isset($_SESSION["last_activity"]) && (time() - $_SESSION["last_activity"]) > $timeout) {
    session_unset(); // Verwijdert alle sessievariabelen
    session_destroy(); // Beëindigt de sessie
    header("Location: logout.php"); // Redirect naar uitlogpagina
    exit();
} else {
    $_SESSION["last_activity"] = time(); // Vernieuwt het tijdstempel van de laatste activiteit
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Controleer of de CSRF-token overeenkomt
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        // CSRF-token komt niet overeen, afwijzen
        die("CSRF-aanval gedetecteerd!");
    } else {
        $Werkmail = $_POST["Werkmail"];
        $gebruikerid = $_POST["gebruikerid"];
        $sql = "SELECT Werkmail, Voornaam FROM medewerkers WHERE Werkmail = ? AND ID = ?";
        $stmt = mysqli_prepare($data, $sql);
        mysqli_stmt_bind_param($stmt, "ss", $Werkmail, $gebruikerid);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($result !== false && $result->num_rows == 1) {
            $row = mysqli_fetch_assoc($result);
            $Werkmail = $row['Werkmail'];
            $Voornaam = $row["Voornaam"];
            $_SESSION["Voornaam"] = $Voornaam;
            $_SESSION["Werkmail"] = $Werkmail;
            $_SESSION["last_activity"] = time(); // Slaat het tijdstempel van de laatste activiteit op
            header("Location: Home.php");
            exit();
        } else {
            echo '';
        }
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Login form</title>
    <link rel="stylesheet" href="inloggen.css">
</head>
<body>
    <center>
        <div>
            <h1>Uren Registratiesysteem</h1>
            <div class="container5">
                <div class="topbar5">
                    <h2>Inloggen</h2>
                    <?php
                     if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($result) && $result->num_rows != 1) {
                     echo '<p class="error-message">Onjuist gebruikersnaam of wachtwoord</p>';
                    }
                        ?>
                    <form action="" method="post">
                        <div class="form-group">
                            <label for="Werkmail">Email:</label>
                            <input type="text" name="Werkmail" id="Werkmail" placeholder="Email">
                        </div>
                        <div class="form-group">
                            <label for="gebruikerid">Gebruiker ID:</label>
                            <input type="text" name="gebruikerid" id="gebruikerid" placeholder="Gebruiker ID">
                        </div>
                        <input type="hidden" name="csrf_token"
                            value="<?php echo htmlspecialchars(generate_csrf_token(), ENT_QUOTES, 'UTF-8'); ?>">
                        <input type="submit" value="Inloggen">
                    </form>
                    <!--a href="forgot_password.php">Wachtwoord vergeten?</a-->
                </div>
            </div>
        </div>
    </center>
</body>

</html>