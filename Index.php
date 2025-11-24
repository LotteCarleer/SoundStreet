
<?php



session_start();

include 'includes/nav.php';

if(!isset($_SESSION["logged_in"]) || $_SESSION["logged_in"] !== true){
    header("Location: login.php");
    exit;
}

?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="css/normalize.css">
</head>
<body>
    <h1>Welkom bij SoundStreet!</h1>

    <p><a href="logout.php">uitloggen</a></p>

    <h2>Categorieën</h2>
    <a href="index.php">Alle Producten</a>

    <h2>Producten</h2>
    
</body>
</html>