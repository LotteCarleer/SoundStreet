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
<style>
  
  body{
    font-family: Arial, Helvetica, sans-serif;
  }

  .cart{
    max-width: 1000px;
    margin: 20px;
    display: flex;
    gap: 40px;
  }

  .cart-items{
   flex: 2;

  }

  .cart-item{
    background-color: #bdb6aa;
    border-radius: 15px;
    padding: 20px;
    display: flex;
    gap: 20px;
    margin-bottom: 20px;
    align-items: center;
  }

  .cart-item img{
     width: 120px;
     border-radius: 10px;
     background: white;
     padding: 10px;
}

.info{
   flex: 1;
}

.price{
    font-weight: bold;
}

.overzicht{
    flex: 1;
    border: 2px solid #9A8570;
    border-radius: 15px;
    padding: 20px;
    height: fit-content;
}

.overzicht button{
    width: 100%;
    padding: 10px;
    margin-top: 15px;
    background-color: #d6c9ae;
    border: none;
    border-radius: 8px;
    cursor: pointer;
}


</style>


</head>
<body>

<h1>Winkelmandje</h1>
<p>Je hebt <?= count($_SESSION["cart"]) ?> artikelen in je winkelmand</p>

<div class="cart" >

<div class="cart-items" > 

<?php foreach ($_SESSION["cart"] as $item): ?>
<div class="cart-item" >
    <img src="<?= $item["image"] ?>" alt="product">

    <div class="info">
        <h3><?= htmlspecialchars($item["title"]) ?></h3>
        <p>Wordt binnen 2 werkdagen bezorgd</p>
    </div>

    <div class="price">
        <?= $item["price"] ?> SoundCoins
    </div>

</div>
<?php endforeach; ?>

<?php if (empty($_SESSION["cart"])): ?>
<p>Je winkelmandje is leeg</p>
<?php endif; ?>
</div>

<div class="overzicht" >
    <h3>Besteloverzicht</h3>

    <p>Subtotaal: <?= $subtotal ?>SoundCoins</p>
    <p>Verzending: <?= $shipping ?> SoundCoins</p>
    <br>
    <p><strong>Totaal: <?= $total ?> SoundCoins</strong></p>

    <button>Betaal met SoundCoins</button>


</div>

</div>

<a href="product.php">Verder winkelen</a>
    
</body>
</html>