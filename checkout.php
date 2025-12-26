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

    .checkout{
       max-width: 600px;
       margin: 80px auto;
       background-color: #B2AB9F;
       padding: 40px;
       border-radius: 20px;
       text-align: center;

    
    }

    .checkout h1{
        margin-top: 0;
    }

    .checkout p{
        font-size: 20px;
        margin: 15px 0;
    }

    .saldo{
        font-weight: bold;
        font-size: 22px;
        margin-top: 20px;
    }

    .checkout button{
        margin-top: 30px;
        padding: 12px 25px;
        background-color: #FAFAF9;
        border: none;
        border-radius: 10px;
        font-size: 18px;
        cursor: pointer;
        font-weight: bold;
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