<?php
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
        $username = $_POST["username"];
        $password = $_POST["password"];
        $sql = "SELECT * FROM users WHERE name='" . $username . "' AND password='" . $password . "'";
        $result = mysqli_query($data, $sql);
        $row = mysqli_fetch_array($result);

        if ($row !== null && ($row["role"] == "gebruiker" || $row["role"] == "beheerder")) {
            // Gebruikersnaam en wachtwoord correct
            $_SESSION["username"] = $username;
            header("Location: Home.php");
        } else {
            // Gebruikersnaam of wachtwoord onjuist
            echo "Gebruikersnaam of wachtwoord onjuist";
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
    </style>
</head>
<body>
    <center>
        
        <div>
        <h1>Login form</h1>
            <div class="container5">
            
            <div class=topbar5>
                <h2>Inloggen</h2>
                <form action="login.php" method="post">
                    <label for="username">Gebruikersnaam:</label>
                    <input type="text" id="username" name="username" required>
                    <label for="password">Wachtwoord:</label>
                    <input type="password" id="password" name="password" required>
                    <button type="submit">Inloggen</button>
                </form>
                <a href="forgot_password.php">Wachtwoord vergeten?</a>
            </div>
        </div>
        </div>
    </center>
</body>
</html>