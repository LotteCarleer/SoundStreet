<?php 

session_start();

if (!isset($_SESSION["logged_in"])){

    header("Location: login.php");
    exit;

}

include_once(__DIR__ . "/classes/database.php");

$db = new Database();

$stmt = $db->prepare("SELECT * FROM orders WHERE user_id = ? ORDER BY created_at DESC");
$stmt->execute([$_SESSION["user_id"]]);
$orders = $stmt->fetchAll();


?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mijn bestellingen</title>
</head>
<body>

<h1>Mijn bestellingen</h1>


<?php if (empty($orders)): ?>
<p>Je hebt nog geen bestellingen geplaatst</p>
<?php endif; ?>

<?php foreach ($orders as $order): ?>

<div class="order">

<h3>Bestelling: <?php echo $order["id"]; ?></h3>
<p>Datum: <?php echo $order["created_at"]; ?> </p>
<p>Totaal: <?php echo $order["total"]; ?> SoundCoins</p>

<h4>Artikelen</h4>

<ul>

<?php

$stmt = $db->prepare("SELECT * FROM order_items WHERE order_id = ?");
$stmt->execute([$order["id"]]);
$items = $stmt->fetchAll();

foreach ($items as $item):
?>

<li>
<?php echo htmlspecialchars($item["product_title"]); ?> -
<?php  echo $item["product_price"]; ?> SoundCoins
</li>
<?php endforeach; ?>


</ul>
    

</div>

<?php endforeach; ?>

<a href="account.php">Terug naar account</a>
    
</body>
</html>