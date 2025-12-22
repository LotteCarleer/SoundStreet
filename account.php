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

<p><strong>Gebruikersnaam:</strong><?= $_SESSION["username"] ?></p>
<p><strong>Wallet:</strong> <?=  $_SESSION["wallet"] ?>  SoundCoins</p>

<?php if (isset($_SESSION["is_admin"]) && $_SESSION["is_admin"] == 1 ): ?>
<a href="admin/products.php">Ga naar admin</a>
<?php endif; ?>

<br>

<a href="change_password.php">Wijzig wachtwoord</a>

<br>

<a href="logout.php">uitloggen</a>

    
</body>
</html>