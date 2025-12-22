<?php

session_start();

include 'includes/nav.php';

if (!isset($_SESSION["logged_in"]) || $_SESSION["logged_in"] !== true ){
    header("Location: login.php");
    exit;
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mijn account</title>
    <link rel="stylesheet" href="css/normalize.css">
</head>
<body>

<h2>Mijn account</h2>

<p><strong>Gebruikersnaam:</strong></p>
<p><strong>Wallet:</strong> SoundCoins</p>

<a href="admin/products.php">Ga naar admin</a>

<a href="logout.php">uitloggen</a>
    
</body>
</html>