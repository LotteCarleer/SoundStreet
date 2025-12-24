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

if(!isset($_SESSION["cart"])){
    $_SESSION["cart"] = [];
}

if (isset($_POST["product_id"])){
    $product = $productObj->find($_POST["product_id"]);

    if ($product){
        $_SESSION["cart"][] = $product;
    }
}

$subtotal = 0;
foreach ($_SESSION["cart"] as $item){
    $subtotal += $item["price"];
}

$shipping = 2;
$total = $subtotal + $shipping;



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
<p>Je hebt <?= count($_SESSION["cart"]) ?> artikelen in je winkelmand</p>

<div>

<div>

<?php foreach ($_SESSION["cart"] as $item): ?>
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
<?php endforeach; ?>

<?php if (empty($_SESSION["cart"])): ?>
<p>Je winkelmandje is leeg</p>
<?php endif; ?>
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