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

<style>

    body{
        font-family: Arial, Helvetica, sans-serif;
        background-color: #F5F5F5;
    }



     

</style>
    
</head>
<body>
    
<div class="checkout" >
<h1>Bedankt voor je aankoop!</h1>

<p>Je betaling met soundCoins is succesvol afgerond.</p>

<p class="saldo" >Huidig saldo: </strong> <?= $_SESSION["wallet"] ?></p>

<a href="account.php">
    <button>Ga naar mijn account</button>
</a>
</div>

</body>
</html>