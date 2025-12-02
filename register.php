<?php

session_start();
include_once(__DIR__ . "/classes/database.php");


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registreren</title>
</head>
<body>

<h2>Registreren</h2>

<form method="POST">
    <input type="text" name="username" placeholder="Gebruikersnaam"><br>
    <input type="email" name="email" placeholder="Email" ><br>
    <input type="password" name="password" placeholder="Wachtwoord"><br>
    <button type="submit">Registreren</button>
</form>

<p>Heb je al een account? <a href="login.php">Log in</a></p>
</body>
</html>