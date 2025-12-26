<?php 

session_start();

if (!isset($_SESSION["logged_in"])){
    header("Location: login.php");
    exit;
}


?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bestelling bevestigd</title>
    
</head>
<body>
    
<h1>Bedankt voor je aankoop!</h1>

<p>Je betaling met soundCoins is succesvol afgerond.</p>

<p><strong>Huidig saldo: </strong></p>

<a href="account.php">
    <button>Ga naar mijn account</button>
</a>


</body>
</html>