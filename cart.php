<?php 

session_start();

if (!isset($_SESSION["logged_in"])){
    header("Location: login.php");
    exit;
}

include_once(__DIR__ . "/classes/database.php");
include_once(__DIR__ . "/classes/Product.php");

$db = new Database();
$productObj = new Product($db);



?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Winkelmandje</title>
</head>
<body>

<h1>Winkelmandje</h1>
<p>Je hebt ... artikelen in je winkelmand</p>

<div>

<div>

<div>
    <img src="<?= $item["image"] ?>" alt="product">

    <div>
        <h3><?= htmlspecialchars($item["title"]) ?></h3>
        <p>Wordt binnen 2 werkdagen bezorgd</p>
    </div>

    <div>
        <?= $item["price"] ?> SoundCoins
    </div>

</div>

<p>Je winkelmandje is leeg</p>

</div>

<div>
    <h3>Besteloverzicht</h3>

    <p>Subtotaal: SoundCoins</p>
    <p>Verzending: SoundCoins</p>
    <br>
    <p><strong>Totaal: SoundCoins</strong></p>

    <button>Betaal met SoundCoins</button>


</div>

</div>

<a href="product.php">Verder winkelen</a>
    
</body>
</html>