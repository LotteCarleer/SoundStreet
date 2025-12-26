<?php 

session_start();

include 'includes/nav.php';

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

if (isset($_POST["remove"])){
    $index = $_POST["remove"];

    if(isset($_SESSION["cart"][$index])){
        unset($_SESSION["cart"][$index]);
    }
}

$subtotal = 0;
foreach ($_SESSION["cart"] as $item){
    $subtotal += $item["price"];
}

$shipping = 2;
$total = $subtotal + $shipping;

$error = "";

if (isset($_POST["checkout"])){

    if (empty($_SESSION["cart"])){

        $error = "Je winkelmandje is leeg";
    } 
    
    elseif ($_SESSION["wallet"]< $total) {
        $error = "Je hebt onvoldoende SoundCoins";
    } 

    else {
        $_SESSION["wallet"] -= $total;

        $stmt = $db->prepare("UPDATE users SET wallet = ? WHERE id = ?");
        $stmt->execute([$_SESSION["wallet"], $_SESSION["user_id"]]);

        $_SESSION["cart"] = [];

        $stmt = $db->prepare("INSERT INTO orders (user_id, total, created_at) VALUES (?, ?, NOW())");
        $stmt->execute([$_SESSION["user_id"], $total]);

        $order_id = $db->lastInsertId();

        foreach ($_SESSION["cart"] as $item){
            $stmt = $db->prepare("INSERT INTO order_items (order_id, product_title, product_price) VALUES (?, ?, ?)");

            $stmt->execute([$order_id, $item["title"], $item["price"]]);
        }

        header("Location: checkout.php");
        exit;
    }

  
    
    
}


?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Winkelmandje</title>
    <link rel="stylesheet" href="css/normalize.css">
<style>
  
  body{
    font-family: Arial, Helvetica, sans-serif;
    
  }

 

  .cart{
    max-width: 1200px;
    margin: 40px  ;
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

<?php foreach ($_SESSION["cart"] as $index => $item): ?>

<div class="cart-item" >
    <img src="<?= $item["image"] ?>" alt="product">

    <div class="info">
        <h3><?= htmlspecialchars($item["title"]) ?></h3>
        <p>Wordt binnen 2 werkdagen bezorgd</p>
    </div>

    <div class="price">
        <?= $item["price"] ?> SoundCoins
    </div>

    
    <form method="POST">
        <input type="hidden" name="remove" value="<?= $index ?>" >
        <button type="submit">
            🗑️
        </button>
    </form>
    

</div>
<?php endforeach; ?>

<?php if (empty($_SESSION["cart"])): ?>
    <?php if ($error != ""): ?>
<p style="color:red;" ><?= $error ?></p>
<?php endif; ?>

<?php endif; ?>
</div>

<div class="overzicht" >
    <h3>Besteloverzicht</h3>

    <p>Subtotaal: <?= $subtotal ?>SoundCoins</p>
    <p>Verzending: <?= $shipping ?> SoundCoins</p>
    <br>
    <p><strong>Totaal: <?= $total ?> SoundCoins</strong></p>

<form method="POST">
    <button type="submit" name="checkout" >Betaal met SoundCoins</button>
</form>

</div>

</div>

<a href="product.php">Verder winkelen</a>

<?php include 'includes/footer.php'; ?>
    
</body>
</html>