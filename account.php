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

    <style>

        body{
            font-family: Arial, Helvetica, sans-serif;
            background-color: #FAFAF9;
        }

        .account-container{
            max-width: 600px;
            margin: 60px;
            padding: 30px;
        }

        .account-container h2{
            text-align: center;
            margin-bottom: 3àpx;
        }

        .account-info{
            background-color: #D1C2A7;
            padding: 25px;
            border-radius: 15px;
            margin-bottom: 30px;
        }

        .account-info p{
            font-size: 18px;
            margin: 10px 0;
        }

        .wallet{
            font-size: 22px;
            font-weight: bold;
            margin-top: 20px;
        }

        .account-links{
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .account-links a{
            text-decoration: none;
            background-color: #9A8570;
            color: white;
            padding: 12px;
            border-radius: 10px;
            text-align: center;
            font-weight: bold;
        }



    </style>

   
</head>
<body>

<div class="account-container">
<h2>Mijn account</h2>

<div class="account-info">
<p><strong>Gebruikersnaam:</strong><?= $_SESSION["username"] ?></p>
<p class="wallet"><strong>Wallet:</strong> <?=  $_SESSION["wallet"] ?>  SoundCoins</p>
</div>

<div class="account-links" > 
<?php if (isset($_SESSION["is_admin"]) && $_SESSION["is_admin"] == 1 ): ?>
<a href="admin/products.php" class="admin" >Ga naar admin</a>
<?php endif; ?>

<br>

<a href="orders.php">Bestellingen</a>

<br>


<a href="change_password.php">Wijzig wachtwoord</a>

<br>

<a  href="logout.php" class="logout" >uitloggen</a>

</div>

</div>

    
</body>
</html>