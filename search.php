<?php 

session_start();

if (!isset($_SESSION["logged_in"])){
    header("location: login.php");
    exit;
}

include_once(__DIR__ . "/classes/database.php");
include_once(__DIR__ . "/classes/Product.php");

if (!isset($_GET["search"]) || $_GET["search"] === "" ){
    header("Location: product.php");
    exit;
}

$db = new Database();
$productObj = new Product($db);

$search = "%" . $_GET["search"] . "%";

$stmt = $db->prepare("SELECT * FROM products WHERE title LIKE ? OR artist LIKE ? OR genre LIKE ?");
$stmt->execute([$search, $search, $search]);

$products = $stmt->fetchAll();





?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zoeken</title>
</head>
<body>

<h1>Zoekresultaten voor "<?= htmlspecialchars($_GET["search"]) ?>"</h1>

<?php if (empty($products)): ?>
<p>Geen producten gevonden</p>
<?php endif; ?>

<?php foreach ($products as $p): ?>
<div class="product">

<h3><?= htmlspecialchars($p["title"]) ?></h3>
<p><?= htmlspecialchars($p["artist"]) ?></p>
<p> <?= $p["price"] ?> SoundCoins</p>
<a href="product_detail.php?id=<?= $p["id"] ?>">Bekijk details</a>

</div>
<?php endforeach; ?>

<a href="product.php">Terug naar producten</a>
    
</body>
</html>